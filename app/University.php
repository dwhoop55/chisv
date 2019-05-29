<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class University extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public static function byDomain($domain)
    {
        return University::ByPattern($domain, false);
    }

    public static function byEmail($email)
    {
        $domain = substr($email, strpos($email, '@') + 1);
        $university = University::byDomain($domain);

        // When we haven't found a university yet we start
        // stripping subsomains as long as there are still
        // at least two dots in the domain
        // TODO: correctly strip by TLDs not only dots
        while ($university->count() < 1 && substr_count($domain, ".") > 1) {
            $domain = substr($domain, strpos($domain, '.') + 1);
            $university = University::byDomain($domain);
        }
        return $university;
    }

    public static function ByPattern($pattern, $name = true, $domain = true)
    {
        $query = DB::table('universities')->where("id", "-1");

        if ($name) {
            $query->orWhere('name', 'LIKE', "%$pattern%");
        }
        if ($domain) {
            $query->orWhere('url', 'LIKE', "%$pattern%");
        }
        $entries = $query->select('id')->get();

        $universities = new Collection();
        foreach ($entries as $entry) {
            $university = University::find($entry->id);
            $universities->push($university);
        }
        return $universities;
    }
}
