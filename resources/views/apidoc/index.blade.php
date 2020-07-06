<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="{{ asset('/docs/css/style.css') }}" />
    <script src="{{ asset('/docs/js/all.js') }}"></script>


          <script>
        $(function() {
            setupLanguages(["bash","javascript"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="/docs/images/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/docs/images/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="bash">bash</a>
                                  <a href="#" data-language-name="javascript">javascript</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
                    <ul class="toc-footer">
                                  <li><a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a></li>
                            </ul>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>Info</h1>
<p>Welcome to the generated API reference.
<a href="{{ route("apidoc.json") }}">Get Postman Collection</a></p>
<!-- END_INFO -->
<h1>Bid</h1>
<!-- START_a9a4a5979919df0c5e0e18a1a69536ca -->
<h2>Create multiple bids at once by params</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/bid/multi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"conference_id":"1","search":"A","days":["2020-07-01","2020-07-02"],"priorities":[1,2,3],"interval":["07:00:00","20:15:00"],"preference":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/bid/multi"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "conference_id": "1",
    "search": "A",
    "days": [
        "2020-07-01",
        "2020-07-02"
    ],
    "priorities": [
        1,
        2,
        3
    ],
    "interval": [
        "07:00:00",
        "20:15:00"
    ],
    "preference": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "created": 15,
    "updated": 2,
    "untouched": 0,
    "revoked": 0
}</code></pre>
<blockquote>
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "You are not an SV with state accepted for this conference"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/bid/multi</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference_id</code></td>
<td>required</td>
<td>optional</td>
<td>The conference's id</td>
</tr>
<tr>
<td><code>search</code></td>
<td>string</td>
<td>optional</td>
<td>Search string</td>
</tr>
<tr>
<td><code>days</code></td>
<td>array&lt;string&gt;</td>
<td>required</td>
<td>Array of strings. Limit to array of specific days YYYY-MM-DD</td>
</tr>
<tr>
<td><code>days[0]</code></td>
<td>string</td>
<td>optional</td>
<td>A day</td>
</tr>
<tr>
<td><code>days[1]</code></td>
<td>string</td>
<td>optional</td>
<td>A day</td>
</tr>
<tr>
<td><code>priorities</code></td>
<td>array&lt;int&gt;</td>
<td>required</td>
<td>Array of ints. Limit to array of specific priorities</td>
</tr>
<tr>
<td><code>priorities[0]</code></td>
<td>integer</td>
<td>optional</td>
<td>A priority</td>
</tr>
<tr>
<td><code>priorities[1]</code></td>
<td>integer</td>
<td>optional</td>
<td>A priority</td>
</tr>
<tr>
<td><code>priorities[2]</code></td>
<td>integer</td>
<td>optional</td>
<td>A priority</td>
</tr>
<tr>
<td><code>interval</code></td>
<td>array&lt;string&gt;</td>
<td>required</td>
<td>Array of strings. Limit the time, has two items</td>
</tr>
<tr>
<td><code>interval[0]</code></td>
<td>string</td>
<td>required</td>
<td>Start time</td>
</tr>
<tr>
<td><code>interval[1]</code></td>
<td>string</td>
<td>required</td>
<td>End time</td>
</tr>
<tr>
<td><code>preference</code></td>
<td>integer</td>
<td>optional</td>
<td>Set to preference 0-3 or null/do not sent to revoke bids</td>
</tr>
</tbody>
</table>
<!-- END_a9a4a5979919df0c5e0e18a1a69536ca -->
<!-- START_9fce453a3e595aade744fb3fc0a0e2e9 -->
<h2>Create a bid (place a bid)</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/bid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"task_id":117,"preference":20}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/bid"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "task_id": 117,
    "preference": 20
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 852,
        "preference": 1,
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        },
        "can_update": true
    },
    "message": "Bid created"
}</code></pre>
<blockquote>
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "You are not authorized to create a bid for this task"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/bid</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>task_id</code></td>
<td>integer</td>
<td>required</td>
<td>The task to bid on by id</td>
</tr>
<tr>
<td><code>preference</code></td>
<td>integer</td>
<td>required</td>
<td>The desired preference (0-3)</td>
</tr>
</tbody>
</table>
<!-- END_9fce453a3e595aade744fb3fc0a0e2e9 -->
<!-- START_5811c4a814de9e3ff677353e5c4301be -->
<h2>Update a bid</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/bid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"preference":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/bid/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "preference": 1
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 853,
        "preference": 2,
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        },
        "can_update": true
    },
    "message": "Bid updated"
}</code></pre>
<blockquote>
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "You are not authorized to update this bid"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/bid/{bid}</code></p>
<p><code>PATCH api/v1/bid/{bid}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>bid</code></td>
<td>required</td>
<td>The bid's id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>preference</code></td>
<td>integer</td>
<td>required</td>
<td>The desired preference (0-3)</td>
</tr>
</tbody>
</table>
<!-- END_5811c4a814de9e3ff677353e5c4301be -->
<!-- START_74ccf8c879de4a05e19be109ef3f3031 -->
<h2>Delete a bid (revoke)</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/bid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/bid/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Bid removed"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/bid/{bid}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>bid</code></td>
<td>required</td>
<td>The bid's id</td>
</tr>
</tbody>
</table>
<!-- END_74ccf8c879de4a05e19be109ef3f3031 -->
<h1>Calendar</h1>
<!-- START_9138d29dfb0e2d156770317318a71746 -->
<h2>Get all calendar events</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/calendar_event?start=2019-01-01&amp;end=2024-01-01" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/calendar_event"
);

let params = {
    "start": "2019-01-01",
    "end": "2024-01-01",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "assignments": [
        {
            "title": "Appliance Repairer",
            "description": "Virtual incremental application",
            "location": "73794 Wilber Coves Apt. 318",
            "timezone": "Pacific\/Honolulu",
            "start": "2020-07-01 08:00:00",
            "end": "2020-07-01 09:00:00",
            "assignment": {
                "state": {
                    "name": "assigned",
                    "description": "The task is assigned but yet not being worked on"
                },
                "hours": "1.0"
            }
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/calendar_event</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>start</code></td>
<td>optional</td>
<td>string required the start time of events</td>
</tr>
<tr>
<td><code>end</code></td>
<td>optional</td>
<td>string required the end time of events</td>
</tr>
</tbody>
</table>
<!-- END_9138d29dfb0e2d156770317318a71746 -->
<h1>Conference</h1>
<!-- START_2e83181b692a4c6e06e67e83ff01e3a7 -->
<h2>Get a preview of all open conferences for public display</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/preview" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/preview"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "CHI 2020",
        "location": "Honolulu, Hawaiʻi, USA",
        "state_id": 4,
        "icon": null,
        "artwork": null,
        "state": {
            "id": 4,
            "name": "running",
            "for": "App\\Conference",
            "description": "The conference is running"
        }
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/preview</code></p>
<!-- END_2e83181b692a4c6e06e67e83ff01e3a7 -->
<!-- START_26469f0e30c54012b5528c0375f72106 -->
<h2>Create a notification for users of a conference</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"destinations":[{"type":"user","user_id":1},{"type":"group","role_id":10,"state_id":12},{"type":"email","email":"test@example.com"}],"elements":[{"type":"action","data":{"caption":"CHISV Website","url":"https:\/\/chisv.org"}},{"type":"markdown","data":"!See text below"}],"subject":"Announcement","greeting":"Hi!","salutation":"Cheers"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "destinations": [
        {
            "type": "user",
            "user_id": 1
        },
        {
            "type": "group",
            "role_id": 10,
            "state_id": 12
        },
        {
            "type": "email",
            "email": "test@example.com"
        }
    ],
    "elements": [
        {
            "type": "action",
            "data": {
                "caption": "CHISV Website",
                "url": "https:\/\/chisv.org"
            }
        },
        {
            "type": "markdown",
            "data": "!See text below"
        }
    ],
    "subject": "Announcement",
    "greeting": "Hi!",
    "salutation": "Cheers"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "9 users will be notified via the available channels (e.g. email, web notification system). You may check 'Background Jobs'."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/conference/{conference}/notification</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference to get by key</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>destinations</code></td>
<td>array</td>
<td>required</td>
<td>Multiple destinations, see below for 3 examples</td>
</tr>
<tr>
<td><code>destinations[0].type</code></td>
<td>string</td>
<td>required</td>
<td>One of 'user', 'group' or 'email'</td>
</tr>
<tr>
<td><code>destinations[1].type</code></td>
<td>string</td>
<td>required</td>
<td>One of 'user', 'group' or 'email'</td>
</tr>
<tr>
<td><code>destinations[2].type</code></td>
<td>string</td>
<td>required</td>
<td>One of 'user', 'group' or 'email'</td>
</tr>
<tr>
<td><code>destinations[0].user_id</code></td>
<td>integer</td>
<td>optional</td>
<td>Is required if type is 'user' pointing to the user by id</td>
</tr>
<tr>
<td><code>destinations[1].role_id</code></td>
<td>integer</td>
<td>optional</td>
<td>Is required if type is 'group' pointing to the role by id</td>
</tr>
<tr>
<td><code>destinations[1].state_id</code></td>
<td>integer</td>
<td>optional</td>
<td>Used if type is 'group' pointing to the state by id</td>
</tr>
<tr>
<td><code>destinations[2].email</code></td>
<td>string</td>
<td>optional</td>
<td>Used if type is 'email' and is the (external) user's email</td>
</tr>
<tr>
<td><code>elements</code></td>
<td>array</td>
<td>required</td>
<td>Multiple elements, see below for action and markdown below</td>
</tr>
<tr>
<td><code>elements[0].type</code></td>
<td>required</td>
<td>optional</td>
<td>One of 'action', 'markdown'</td>
</tr>
<tr>
<td><code>elements[1].type</code></td>
<td>required</td>
<td>optional</td>
<td>One of 'action', 'markdown'</td>
</tr>
<tr>
<td><code>elements[0].data.caption</code></td>
<td>string</td>
<td>optional</td>
<td>Is required if type is 'action'</td>
</tr>
<tr>
<td><code>elements[0].data.url</code></td>
<td>string</td>
<td>optional</td>
<td>Is required if type is 'action'</td>
</tr>
<tr>
<td><code>elements[1].data</code></td>
<td>string</td>
<td>optional</td>
<td>Is required if type is 'markdown'</td>
</tr>
<tr>
<td><code>subject</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>greeting</code></td>
<td>string</td>
<td>optional</td>
</tr>
<tr>
<td><code>salutation</code></td>
<td>string</td>
<td>optional</td>
</tr>
</tbody>
</table>
<!-- END_26469f0e30c54012b5528c0375f72106 -->
<!-- START_6f994d80b087d97a28f05807f764d427 -->
<h2>Create or update multiple tasks by import</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/task" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/task"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": 4,
    "message": "Task import for CHI 2020 has been queued as a new job"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/conference/{conference}/task</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<!-- END_6f994d80b087d97a28f05807f764d427 -->
<!-- START_f64e5ca08b84e78958c7662c1d09e175 -->
<h2>Enroll a user to be an SV for the conference with state &#039;enrolled&#039;</h2>
<p>Use a dictionary of field names as keys value pairs.
Use the field names from the currently active enrollment form. The
fields below are just examples.</p>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/enroll/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"id":1,"":{"fields":"corrupti"}}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/enroll/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "id": 1,
    "": {
        "fields": "corrupti"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "You are now enrolled"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "The given data was invalid.",
    "errors": {
        "why_you_want_to_be_sv": [
            "'Why You Want To Be Sv' has to have some text",
            "'Why You Want To Be Sv' has to be provided"
        ]
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/conference/{conference}/enroll/{user?}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
<tr>
<td><code>user</code></td>
<td>optional</td>
<td>The user's id. Defaults to the authenticated user when missing</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>integer</td>
<td>required</td>
<td>The referencing enrollment form id.</td>
</tr>
<tr>
<td><code>[fields]</code></td>
<td>type</td>
<td>required</td>
<td>Each field of the referencing enrollment form. Can be multiple and is highly dynamic.</td>
</tr>
</tbody>
</table>
<!-- END_f64e5ca08b84e78958c7662c1d09e175 -->
<!-- START_7f0a19b80f91e8103d71c08929879ce4 -->
<h2>Unenrolls a user from the conference</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20/enroll/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/enroll/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "success": true,
    "message": "You are now longer enrolled"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/conference/{conference}/enroll/{user?}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
<tr>
<td><code>user</code></td>
<td>optional</td>
<td>The user's id. Defaults to the authenticated user when missing</td>
</tr>
</tbody>
</table>
<!-- END_7f0a19b80f91e8103d71c08929879ce4 -->
<!-- START_0667c97952d689c7b7f3678408614889 -->
<h2>Run the auction</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/auction/2020-07-01" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/auction/2020-07-01"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": 4,
    "message": "Auction for CHI 2020 on 2020-07-01 has been queued as a new job"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/conference/{conference}/auction/{day}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
<tr>
<td><code>day</code></td>
<td>required</td>
<td>The day to run the auction for</td>
</tr>
</tbody>
</table>
<!-- END_0667c97952d689c7b7f3678408614889 -->
<!-- START_1c60d0e5f7c369f2025c4ea4cc372f15 -->
<h2>Run the lottery</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/lottery" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/lottery"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": 4,
    "message": "Lottery for CHI 2020 has been queued as a new job"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/conference/{conference}/lottery</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<!-- END_1c60d0e5f7c369f2025c4ea4cc372f15 -->
<!-- START_b5f90a2ec554bb6daa8173c4a87692cd -->
<h2>Update enrollment form weights based on submitted weights</h2>
<p>Use a dictionary of field names as keys value pairs.
Use the field names from the currently active enrollment form. The
fields below are just examples.</p>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/conference/chi20/update_enrollment_form_weights" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"attended_before":5,"know_city":-15,"need_visa":0,"sved_before":30}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/update_enrollment_form_weights"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "attended_before": 5,
    "know_city": -15,
    "need_visa": 0,
    "sved_before": 30
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Updated 8 enrollment forms weights"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/conference/{conference}/update_enrollment_form_weights</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>attended_before</code></td>
<td>integer</td>
<td>required</td>
<td>An example field</td>
</tr>
<tr>
<td><code>know_city</code></td>
<td>integer</td>
<td>required</td>
<td>An example field</td>
</tr>
<tr>
<td><code>need_visa</code></td>
<td>integer</td>
<td>required</td>
<td>An example field</td>
</tr>
<tr>
<td><code>sved_before</code></td>
<td>integer</td>
<td>required</td>
<td>An example field</td>
</tr>
</tbody>
</table>
<!-- END_b5f90a2ec554bb6daa8173c4a87692cd -->
<!-- START_6104d8e4f50d52e65ddd056fc3c09cb7 -->
<h2>Reset all SVs to &#039;enrolled&#039; state</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/conference/chi20/reset_enrollments_to_enrolled" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/reset_enrollments_to_enrolled"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": 8,
    "message": "8 SVs have been reset to state 'enrolled'"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/conference/{conference}/reset_enrollments_to_enrolled</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<!-- END_6104d8e4f50d52e65ddd056fc3c09cb7 -->
<!-- START_5f265df5c8e32f6d8a255cfba0c3c763 -->
<h2>Delete all assignments for the specified day</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20/assignments/2020-12-25" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/assignments/2020-12-25"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": 0,
    "message": "0 assignments have been deleted. 0 bids have been reset to 'placed'"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/conference/{conference}/assignments/{date}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
<tr>
<td><code>date</code></td>
<td>required</td>
<td>Date in YYYY-MM-DD format</td>
</tr>
</tbody>
</table>
<!-- END_5f265df5c8e32f6d8a255cfba0c3c763 -->
<!-- START_376d3892b6c4a9cb6a0469e54f1bef86 -->
<h2>Delete all tasks for specified days</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20/tasks?days=%5B%222020-12-25%22%2C%222020-12-26%22%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/tasks"
);

let params = {
    "days": "["2020-12-25","2020-12-26"]",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": 0,
    "message": "0 tasks, 0 bids and 0 assignments have been deleted"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/conference/{conference}/tasks</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>days</code></td>
<td>required</td>
<td>Array of strings of all days in JSON</td>
</tr>
</tbody>
</table>
<!-- END_376d3892b6c4a9cb6a0469e54f1bef86 -->
<!-- START_f57466b20b11f44b3b332f1ec8380887 -->
<h2>Get all days where the conference has tasks</h2>
<p>We need this for the calendar in the GUI</p>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/task/day" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/task/day"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "2020-07-01": "54",
    "2020-07-02": "41",
    "2020-07-03": "48",
    "2020-07-04": "41",
    "2020-07-05": "51",
    "2020-07-06": "45"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/task/day</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<!-- END_f57466b20b11f44b3b332f1ec8380887 -->
<!-- START_d690463ccada559b947de653028cdd43 -->
<h2>Get all tasks which match the query</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/task?search=A&amp;days=%5B%222020-07-01%22%2C+%222020-07-03%22%5D&amp;priorities=%5B1%2C2%2C3%5D&amp;interval=%5B%2207%3A00%3A00%22%2C+%2220%3A15%3A00%22%5D&amp;sort_by=tasks.start_at&amp;sort_order=asc&amp;per_page=5&amp;page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/task"
);

let params = {
    "search": "A",
    "days": "["2020-07-01", "2020-07-03"]",
    "priorities": "[1,2,3]",
    "interval": "["07:00:00", "20:15:00"]",
    "sort_by": "tasks.start_at",
    "sort_order": "asc",
    "per_page": "5",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "current_page": 1,
    "data": [
        {
            "id": 137,
            "name": "Sketch Artist",
            "location": "460 Morissette Mall Apt. 482",
            "description": "Assimilated reciprocal GraphicInterface",
            "start_at": "08:00:00",
            "end_at": "09:00:00",
            "hours": 1,
            "date": "2020-07-03",
            "slots": 1,
            "priority": 1,
            "conference_id": 1,
            "own_assignment": null,
            "can_create_bid": false,
            "own_bid": {
                "id": 20,
                "preference": 2,
                "user_created": false,
                "state": {
                    "id": 31,
                    "name": "placed",
                    "description": "The bid is waiting for the auction"
                },
                "can_update": true
            }
        },
        {
            "id": 156,
            "name": "Appliance Repairer",
            "location": "73794 Wilber Coves Apt. 318",
            "description": "Virtual incremental application",
            "start_at": "08:00:00",
            "end_at": "09:00:00",
            "hours": 1,
            "date": "2020-07-01",
            "slots": 4,
            "priority": 3,
            "conference_id": 1,
            "own_assignment": {
                "id": 1,
                "hours": "1.0",
                "state": {
                    "id": 41,
                    "name": "assigned",
                    "for": "App\\Assignment",
                    "description": "The task is assigned but yet not being worked on"
                }
            },
            "can_create_bid": false,
            "own_bid": null
        },
        {
            "id": 177,
            "name": "Respiratory Therapist",
            "location": "7620 Carmine Branch",
            "description": "Proactive bandwidth-monitored info-mediaries",
            "start_at": "08:00:00",
            "end_at": "09:30:00",
            "hours": 1.5,
            "date": "2020-07-03",
            "slots": 1,
            "priority": 1,
            "conference_id": 1,
            "own_assignment": null,
            "can_create_bid": true,
            "own_bid": null
        },
        {
            "id": 214,
            "name": "Manager of Food Preparation",
            "location": "2797 Kenyon Islands Suite 415",
            "description": "Centralized zeroadministration GraphicalUserInterface",
            "start_at": "08:00:00",
            "end_at": "10:00:00",
            "hours": 2,
            "date": "2020-07-01",
            "slots": 5,
            "priority": 3,
            "conference_id": 1,
            "own_assignment": null,
            "can_create_bid": false,
            "own_bid": {
                "id": 32,
                "preference": 2,
                "user_created": false,
                "state": {
                    "id": 31,
                    "name": "placed",
                    "description": "The bid is waiting for the auction"
                },
                "can_update": true
            }
        },
        {
            "id": 247,
            "name": "Special Forces Officer",
            "location": "6515 Johns Walks",
            "description": "Exclusive heuristic strategy",
            "start_at": "08:00:00",
            "end_at": "08:30:00",
            "hours": 0.5,
            "date": "2020-07-01",
            "slots": 3,
            "priority": 3,
            "conference_id": 1,
            "own_assignment": null,
            "can_create_bid": false,
            "own_bid": {
                "id": 34,
                "preference": 3,
                "user_created": false,
                "state": {
                    "id": 31,
                    "name": "placed",
                    "description": "The bid is waiting for the auction"
                },
                "can_update": true
            }
        }
    ],
    "first_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/task?page=1",
    "from": 1,
    "last_page": 21,
    "last_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/task?page=21",
    "next_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/task?page=2",
    "path": "http:\/\/localhost\/api\/v1\/conference\/chi20\/task",
    "per_page": "5",
    "prev_page_url": null,
    "to": 5,
    "total": 101
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/task</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>search</code></td>
<td>optional</td>
<td>string Search string</td>
</tr>
<tr>
<td><code>days</code></td>
<td>optional</td>
<td>array of strings. Limit to array of specific days YYYY-MM-DD</td>
</tr>
<tr>
<td><code>priorities</code></td>
<td>optional</td>
<td>array of ints. Limit to array of specific priorities</td>
</tr>
<tr>
<td><code>interval</code></td>
<td>optional</td>
<td>array of strings. Limit the time, has two items</td>
</tr>
<tr>
<td><code>sort_by</code></td>
<td>optional</td>
<td>Key to sort for</td>
</tr>
<tr>
<td><code>sort_order</code></td>
<td>optional</td>
<td>Order to sort for</td>
</tr>
<tr>
<td><code>per_page</code></td>
<td>optional</td>
<td>Tasks per page</td>
</tr>
<tr>
<td><code>page</code></td>
<td>optional</td>
<td>Page to return</td>
</tr>
</tbody>
</table>
<!-- END_d690463ccada559b947de653028cdd43 -->
<!-- START_fc38d63ae1427b7be3f95298245dd14a -->
<h2>Get all assignments and users which match the query</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/assignment?search=A&amp;day=2020-07-01&amp;interval=%5B%2207%3A00%3A00%22%2C+%2220%3A15%3A00%22%5D&amp;sort_by=start_at&amp;sort_order=asc&amp;per_page=5&amp;page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/assignment"
);

let params = {
    "search": "A",
    "day": "2020-07-01",
    "interval": "["07:00:00", "20:15:00"]",
    "sort_by": "start_at",
    "sort_order": "asc",
    "per_page": "5",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "users": {
        "1": {
            "firstname": "ADMIN Milton",
            "lastname": "Waddams",
            "id": 1,
            "hours_done": 0
        }
    },
    "tasks": [
        {
            "id": 156,
            "name": "Appliance Repairer",
            "start_at": "08:00:00",
            "end_at": "09:00:00",
            "hours": 1,
            "location": "73794 Wilber Coves Apt. 318",
            "description": "Virtual incremental application",
            "slots": 4,
            "priority": 3,
            "assignments": [
                {
                    "id": 1,
                    "hours": "1.0",
                    "state": {
                        "id": 41,
                        "name": "assigned"
                    },
                    "user": {
                        "id": 1
                    },
                    "notes": [],
                    "bid": null,
                    "is_conflicting": false
                }
            ]
        },
        {
            "id": 214,
            "name": "Manager of Food Preparation",
            "start_at": "08:00:00",
            "end_at": "10:00:00",
            "hours": 2,
            "location": "2797 Kenyon Islands Suite 415",
            "description": "Centralized zeroadministration GraphicalUserInterface",
            "slots": 5,
            "priority": 3,
            "assignments": []
        },
        {
            "id": 247,
            "name": "Special Forces Officer",
            "start_at": "08:00:00",
            "end_at": "08:30:00",
            "hours": 0.5,
            "location": "6515 Johns Walks",
            "description": "Exclusive heuristic strategy",
            "slots": 3,
            "priority": 3,
            "assignments": []
        },
        {
            "id": 364,
            "name": "Computer Hardware Engineer",
            "start_at": "08:00:00",
            "end_at": "08:45:00",
            "hours": 0.75,
            "location": "77746 Zaria Brooks Apt. 387",
            "description": "Diverse scalable installation",
            "slots": 3,
            "priority": 3,
            "assignments": []
        },
        {
            "id": 481,
            "name": "Transportation Equipment Painters",
            "start_at": "08:00:00",
            "end_at": "08:15:00",
            "hours": 0.25,
            "location": "37036 Furman Crescent",
            "description": "Reduced bi-directional interface",
            "slots": 2,
            "priority": 1,
            "assignments": []
        }
    ],
    "total": 54
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/assignment</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>search</code></td>
<td>optional</td>
<td>string Search string</td>
</tr>
<tr>
<td><code>day</code></td>
<td>optional</td>
<td>string Limit to specific day YYYY-MM-DD</td>
</tr>
<tr>
<td><code>interval</code></td>
<td>optional</td>
<td>array<string> Limit the time, has two items</td>
</tr>
<tr>
<td><code>sort_by</code></td>
<td>optional</td>
<td>Key to sort for</td>
</tr>
<tr>
<td><code>sort_order</code></td>
<td>optional</td>
<td>Order to sort for</td>
</tr>
<tr>
<td><code>per_page</code></td>
<td>optional</td>
<td>Assignments per page</td>
</tr>
<tr>
<td><code>page</code></td>
<td>optional</td>
<td>Assignments per page</td>
</tr>
</tbody>
</table>
<!-- END_fc38d63ae1427b7be3f95298245dd14a -->
<!-- START_25b5224247b0362ec3ea9ef90301c651 -->
<h2>Get all users of a conference matching the query</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/sv?search=A&amp;only_states=%5B11%2C12%2C13%2C14%5D&amp;sort_by=lastname&amp;sort_order=desc&amp;per_page=2&amp;page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/sv"
);

let params = {
    "search": "A",
    "only_states": "[11,12,13,14]",
    "sort_by": "lastname",
    "sort_order": "desc",
    "per_page": "2",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "current_page": 1,
    "data": [
        {
            "firstname": "ADMIN Milton",
            "lastname": "Waddams",
            "id": 1,
            "avatar": null,
            "university": "Rajasthan Technical University",
            "permission": {
                "state": {
                    "id": 12,
                    "name": "accepted",
                    "description": "Accepted to the conference as SV"
                },
                "id": 14,
                "lottery_position": null,
                "created_at": "2020-07-06 17:17:10",
                "enrollment_form": {
                    "name": "Default",
                    "id": 14,
                    "parent_id": 1,
                    "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":false,\"weight\":0,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":0,\"weight\":0,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":2,\"weight\":0,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":true,\"weight\":0,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"sd\",\"required\":true}}}",
                    "total_weight": 0
                },
                "conference": {
                    "id": 1
                },
                "role": {
                    "id": 10
                }
            },
            "country": "Germany",
            "region": "North Rhine-Westphalia",
            "stats": {
                "assignments": {
                    "count": 1,
                    "done": 0
                },
                "hours_done": 0,
                "bids_placed": {
                    "unavailable": 2,
                    "low": 17,
                    "medium": 24,
                    "high": 27
                },
                "bids_successful": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                },
                "bids_conflict": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                }
            },
            "assignments": [
                {
                    "id": 1,
                    "hours": "1.0",
                    "created_at": "2020-07-06T16:44:00.000000Z",
                    "notes": [],
                    "state": {
                        "id": 41,
                        "name": "assigned",
                        "description": "The task is assigned but yet not being worked on"
                    },
                    "task": {
                        "id": 156,
                        "name": "Appliance Repairer",
                        "description": "Virtual incremental application",
                        "location": "73794 Wilber Coves Apt. 318",
                        "date": "2020-07-01T00:00:00.000000Z",
                        "start_at": "08:00:00",
                        "end_at": "09:00:00",
                        "priority": 3,
                        "slots": 4,
                        "hours": 1
                    }
                }
            ],
            "past_conferences": null,
            "past_conferences_sv": null,
            "languages": [
                {
                    "id": 10,
                    "name": "Bashkir"
                },
                {
                    "id": 13,
                    "name": "Bihari"
                }
            ],
            "email": "admin@chisv.org",
            "degree": "Master",
            "city": "Aachen",
            "notes": []
        },
        {
            "firstname": "Alessandro",
            "lastname": "Sanford",
            "id": 2,
            "avatar": null,
            "university": "Abrar University",
            "permission": {
                "state": {
                    "id": 12,
                    "name": "accepted",
                    "description": "Accepted to the conference as SV"
                },
                "id": 2,
                "lottery_position": null,
                "created_at": "2020-07-04 14:12:31",
                "enrollment_form": {
                    "name": "Default",
                    "id": 3,
                    "parent_id": 1,
                    "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":true,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":44,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":21,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":false,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"Qui et quo ut ut. Iure quaerat repellendus harum in aliquid. Qui aut corporis iure ab culpa nobis ut. Autem in repudiandae non fugit voluptates fugit.\",\"required\":true}}}",
                    "total_weight": 0
                },
                "conference": {
                    "id": 1
                },
                "role": {
                    "id": 10
                }
            },
            "country": "South Sudan",
            "region": "Satun",
            "stats": {
                "assignments": {
                    "count": 0,
                    "done": 0
                },
                "hours_done": 0,
                "bids_placed": {
                    "unavailable": 5,
                    "low": 34,
                    "medium": 29,
                    "high": 23
                },
                "bids_successful": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                },
                "bids_conflict": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                }
            },
            "assignments": [],
            "past_conferences": [
                "CHI2020",
                "UIST2020",
                "NordiCHI 2012",
                "DIS 2014",
                "CHI19"
            ],
            "past_conferences_sv": [
                "MobileHCI",
                "UIST2020"
            ],
            "languages": [
                {
                    "id": 16,
                    "name": "Tibetan"
                },
                {
                    "id": 114,
                    "name": "Telugu"
                }
            ],
            "email": "dashawn19@example.org",
            "degree": "PhD - &gt;5 years",
            "city": "East Grand Rapids",
            "notes": []
        }
    ],
    "first_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv?page=1",
    "from": 1,
    "last_page": 4,
    "last_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv?page=4",
    "next_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv?page=2",
    "path": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv",
    "per_page": "2",
    "prev_page_url": null,
    "to": 2,
    "total": 8
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/sv</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>search</code></td>
<td>optional</td>
<td>string Search string</td>
</tr>
<tr>
<td><code>only_states</code></td>
<td>optional</td>
<td>array of ints. Limit to array of specific states</td>
</tr>
<tr>
<td><code>sort_by</code></td>
<td>optional</td>
<td>Key to sort for</td>
</tr>
<tr>
<td><code>sort_order</code></td>
<td>optional</td>
<td>Order to sort for</td>
</tr>
<tr>
<td><code>per_page</code></td>
<td>optional</td>
<td>Users per page</td>
</tr>
<tr>
<td><code>page</code></td>
<td>optional</td>
<td>Page to return</td>
</tr>
</tbody>
</table>
<!-- END_25b5224247b0362ec3ea9ef90301c651 -->
<!-- START_7ade2e103f429985475bfd7e5f3e1d32 -->
<h2>Get all users which are suited to be assigned for a specific task</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/sv_for_task_assignment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/sv_for_task_assignment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "total_matches": 8,
    "returned_matches": 10,
    "svs": [
        {
            "id": 2,
            "firstname": "Alessandro",
            "lastname": "Sanford",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 5,
                    "low": 34,
                    "medium": 29,
                    "high": 23
                }
            }
        },
        {
            "id": 3,
            "firstname": "River",
            "lastname": "Leannon",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 5,
                    "low": 29,
                    "medium": 19,
                    "high": 23
                }
            }
        },
        {
            "id": 4,
            "firstname": "Mara",
            "lastname": "Bergstrom",
            "bid": null,
            "avatar": {
                "web_path": "\/storage\/images\/xUwneYexqYjiVFhyRNr3SjBJfkRQ3vuTUFasTTp5.png"
            },
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 2,
                    "low": 31,
                    "medium": 30,
                    "high": 25
                }
            }
        },
        {
            "id": 7,
            "firstname": "Tom",
            "lastname": "Mante",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 1,
                    "low": 26,
                    "medium": 24,
                    "high": 31
                }
            }
        },
        {
            "id": 8,
            "firstname": "Tito",
            "lastname": "Kuphal",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 4,
                    "low": 27,
                    "medium": 34,
                    "high": 20
                }
            }
        },
        {
            "id": 9,
            "firstname": "Jade",
            "lastname": "Jerde",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 2,
                    "low": 21,
                    "medium": 22,
                    "high": 31
                }
            }
        },
        {
            "id": 11,
            "firstname": "Meagan",
            "lastname": "Runolfsdottir",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 2,
                    "low": 26,
                    "medium": 28,
                    "high": 27
                }
            }
        },
        {
            "id": 1,
            "firstname": "ADMIN Milton",
            "lastname": "Waddams",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 1,
                "bids_placed": {
                    "unavailable": 2,
                    "low": 17,
                    "medium": 24,
                    "high": 27
                }
            }
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/sv_for_task_assignment/{task}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
<tr>
<td><code>task</code></td>
<td>required</td>
<td>The task's id</td>
</tr>
</tbody>
</table>
<!-- END_7ade2e103f429985475bfd7e5f3e1d32 -->
<!-- START_d452bf9aacc3231cbeca5271a88f7359 -->
<h2>Get all the possible notification destinations for a conference</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/destination" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/destination"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "groups": [
        {
            "role_id": 10,
            "type": "group",
            "display": "All SVs"
        },
        {
            "role_id": 10,
            "state_id": 12,
            "type": "group",
            "display": "Accepted SVs"
        },
        {
            "role_id": 10,
            "state_id": 13,
            "type": "group",
            "display": "Waitlisted SVs"
        },
        {
            "role_id": 3,
            "type": "group",
            "display": "Captains"
        }
    ],
    "users": [
        {
            "user_id": 2,
            "type": "user",
            "display": "Alessandro Sanford"
        },
        {
            "user_id": 3,
            "type": "user",
            "display": "River Leannon"
        },
        {
            "user_id": 4,
            "type": "user",
            "display": "Mara Bergstrom"
        },
        {
            "user_id": 7,
            "type": "user",
            "display": "Tom Mante"
        },
        {
            "user_id": 8,
            "type": "user",
            "display": "Tito Kuphal"
        },
        {
            "user_id": 9,
            "type": "user",
            "display": "Jade Jerde"
        },
        {
            "user_id": 11,
            "type": "user",
            "display": "Meagan Runolfsdottir"
        },
        {
            "user_id": 1,
            "type": "user",
            "display": "ADMIN Milton Waddams"
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/destination</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference to get by key</td>
</tr>
</tbody>
</table>
<!-- END_d452bf9aacc3231cbeca5271a88f7359 -->
<!-- START_d047bd6fd41efadb6c04fb272d06f398 -->
<h2>Get all conferences based on user&#039;s permissions</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "CHI 2020",
        "key": "chi20",
        "location": "Honolulu, Hawaiʻi, USA",
        "timezone_id": 366,
        "start_date": "2020-07-01",
        "end_date": "2020-07-07",
        "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
        "enrollment_form_id": 1,
        "state_id": 4,
        "url": "https:\/\/www.acm.org\/",
        "url_name": "ACM",
        "created_at": "2020-07-04 14:12:29",
        "updated_at": "2020-07-06 20:38:18",
        "volunteer_hours": 20,
        "volunteer_max": 100,
        "email_chair": "noreply@chisv.org",
        "bidding_start": "2020-07-01",
        "bidding_end": "2020-07-23",
        "bidding_enabled": true,
        "icon": null,
        "artwork": null,
        "state": {
            "id": 4,
            "name": "running",
            "for": "App\\Conference",
            "description": "The conference is running"
        },
        "timezone": {
            "id": 366,
            "name": "Pacific\/Honolulu"
        }
    },
    {
        "id": 2,
        "name": "DIS 2019",
        "key": "dis19",
        "location": "Torino",
        "timezone_id": 297,
        "start_date": "2019-06-20",
        "end_date": "2019-06-28",
        "description": "Awesome people doing awesome things",
        "enrollment_form_id": 1,
        "state_id": 5,
        "url": "https:\/\/www.acm.org\/",
        "url_name": "ACM",
        "created_at": "2020-07-04 14:12:29",
        "updated_at": "2020-07-04 14:12:29",
        "volunteer_hours": 20,
        "volunteer_max": 100,
        "email_chair": "noreply@chisv.org",
        "bidding_start": "2020-07-04 14:12:29",
        "bidding_end": "2020-07-07 00:00:00",
        "bidding_enabled": true,
        "icon": null,
        "artwork": null,
        "state": {
            "id": 5,
            "name": "over",
            "for": "App\\Conference",
            "description": "The conference is over"
        },
        "timezone": {
            "id": 297,
            "name": "Europe\/Berlin"
        }
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference</code></p>
<!-- END_d047bd6fd41efadb6c04fb272d06f398 -->
<!-- START_c508f5b8d74ec7e81d1746d1c00e2167 -->
<h2>Get a conference by key</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "name": "CHI 2020",
    "key": "chi20",
    "location": "Honolulu, Hawaiʻi, USA",
    "timezone_id": 366,
    "start_date": "2020-07-01",
    "end_date": "2020-07-07",
    "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
    "enrollment_form_id": 1,
    "state_id": 4,
    "url": "https:\/\/www.acm.org\/",
    "url_name": "ACM",
    "created_at": "2020-07-04 14:12:29",
    "updated_at": "2020-07-06 20:38:18",
    "volunteer_hours": 20,
    "volunteer_max": 100,
    "email_chair": "noreply@chisv.org",
    "bidding_start": "2020-07-01",
    "bidding_end": "2020-07-23",
    "bidding_enabled": true,
    "state": {
        "id": 4,
        "name": "running",
        "for": "App\\Conference",
        "description": "The conference is running"
    },
    "icon": null,
    "artwork": null,
    "timezone": {
        "id": 366,
        "name": "Pacific\/Honolulu"
    },
    "enrollment_form_template": {
        "id": 1,
        "name": "Default",
        "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":false,\"weight\":0,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":0,\"weight\":0,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":0,\"weight\":0,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":true,\"weight\":0,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"\",\"required\":true}}}"
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference to get by key</td>
</tr>
</tbody>
</table>
<!-- END_c508f5b8d74ec7e81d1746d1c00e2167 -->
<!-- START_2758127fe734b463e6ced325ab9bb9f1 -->
<h2>Update a conference</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/conference/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"name":"CHI 2020","key":"chi20","location":"Hawaii","timezone_id":366,"start_date":"2020-07-01","end_date":"2020-07-07","description":"!CHI 2020","url_name":"ACM","url":"https:\/\/acm.org","enrollment_form_id":1,"state_id":2,"volunteer_hours":20,"volunteer_max":100,"email_chair":"sv@example.com","bidding_enabled":true,"bidding_start":"2020-07-01","bidding_end":"2020-07-07"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "name": "CHI 2020",
    "key": "chi20",
    "location": "Hawaii",
    "timezone_id": 366,
    "start_date": "2020-07-01",
    "end_date": "2020-07-07",
    "description": "!CHI 2020",
    "url_name": "ACM",
    "url": "https:\/\/acm.org",
    "enrollment_form_id": 1,
    "state_id": 2,
    "volunteer_hours": 20,
    "volunteer_max": 100,
    "email_chair": "sv@example.com",
    "bidding_enabled": true,
    "bidding_start": "2020-07-01",
    "bidding_end": "2020-07-07"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Conference updated"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Conference] chi404"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "The given data was invalid.",
    "errors": {
        "description": [
            "Please give a short intro into the conference"
        ]
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/conference/{conference}</code></p>
<p><code>PATCH api/v1/conference/{conference}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>Conference's name</td>
</tr>
<tr>
<td><code>key</code></td>
<td>string</td>
<td>required</td>
<td>Conference's key</td>
</tr>
<tr>
<td><code>location</code></td>
<td>string</td>
<td>required</td>
<td>Conference's location</td>
</tr>
<tr>
<td><code>timezone_id</code></td>
<td>integer</td>
<td>required</td>
<td>Conference's timezone</td>
</tr>
<tr>
<td><code>start_date</code></td>
<td>string</td>
<td>required</td>
<td>First day</td>
</tr>
<tr>
<td><code>end_date</code></td>
<td>string</td>
<td>required</td>
<td>Last day</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>required</td>
<td>Markdown description of the conference</td>
</tr>
<tr>
<td><code>url_name</code></td>
<td>string</td>
<td>required</td>
<td>Caption for the button on the conference view</td>
</tr>
<tr>
<td><code>url</code></td>
<td>string</td>
<td>required</td>
<td>Url for the button on the conference view</td>
</tr>
<tr>
<td><code>enrollment_form_id</code></td>
<td>integer</td>
<td>required</td>
<td>Conference will use this enrollment form</td>
</tr>
<tr>
<td><code>state_id</code></td>
<td>integer</td>
<td>required</td>
<td>State by id</td>
</tr>
<tr>
<td><code>volunteer_hours</code></td>
<td>integer</td>
<td>required</td>
<td>How long SVs are expected to work</td>
</tr>
<tr>
<td><code>volunteer_max</code></td>
<td>integer</td>
<td>required</td>
<td>How many SVs should be accepted for the conference</td>
</tr>
<tr>
<td><code>email_chair</code></td>
<td>string</td>
<td>required</td>
<td>The SV-Chairs e-mail which is used in the reply field of every e-mail</td>
</tr>
<tr>
<td><code>bidding_enabled</code></td>
<td>boolean</td>
<td>required</td>
<td>Bidding is enabled true/false</td>
</tr>
<tr>
<td><code>bidding_start</code></td>
<td>string</td>
<td>required</td>
<td>Bidding open after this day</td>
</tr>
<tr>
<td><code>bidding_end</code></td>
<td>string</td>
<td>required</td>
<td>Bidding open before this day</td>
</tr>
</tbody>
</table>
<!-- END_2758127fe734b463e6ced325ab9bb9f1 -->
<!-- START_1dcc9627334c1cfef9f9a8aa131da4d5 -->
<h2>Delete a conference</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "success": true,
    "message": "Conference deleted"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/conference/{conference}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<!-- END_1dcc9627334c1cfef9f9a8aa131da4d5 -->
<h1>Enrollment Form</h1>
<!-- START_1e9c98ffcccd3ea600f44f4de8acce1b -->
<h2>Get all enrollment form templates</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/enrollment_form/template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/enrollment_form/template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "parent_id": null,
        "name": "Default",
        "is_template": 1,
        "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":false,\"weight\":0,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":0,\"weight\":0,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":0,\"weight\":0,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":true,\"weight\":0,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"\",\"required\":true}}}",
        "created_at": null,
        "updated_at": null,
        "total_weight": null
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/enrollment_form/template</code></p>
<!-- END_1e9c98ffcccd3ea600f44f4de8acce1b -->
<!-- START_a6a10ba125c19027456c678b8fbc0e58 -->
<h2>Update an enrollment form</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Use a dictionary of field names as keys value pairs.
Use the field names from the currently active enrollment form. The
fields below are just examples.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/enrollment_form/14" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"id":14,"attended_before":5,"know_city":0,"need_visa":0,"sved_before":2,"why_you_want_to_be_sv":"Like the cake"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/enrollment_form/14"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "id": 14,
    "attended_before": 5,
    "know_city": 0,
    "need_visa": 0,
    "sved_before": 2,
    "why_you_want_to_be_sv": "Like the cake"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Form was updated!"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/enrollment_form/{enrollment_form}</code></p>
<p><code>PATCH api/v1/enrollment_form/{enrollment_form}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>enrollment_form</code></td>
<td>required</td>
<td>The enrollment form's id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>integer</td>
<td>required</td>
<td>The forms id</td>
</tr>
<tr>
<td><code>attended_before</code></td>
<td>integer</td>
<td>optional</td>
<td>An example field</td>
</tr>
<tr>
<td><code>know_city</code></td>
<td>integer</td>
<td>optional</td>
<td>An example field</td>
</tr>
<tr>
<td><code>need_visa</code></td>
<td>integer</td>
<td>optional</td>
<td>An example field</td>
</tr>
<tr>
<td><code>sved_before</code></td>
<td>integer</td>
<td>optional</td>
<td>An example field</td>
</tr>
<tr>
<td><code>why_you_want_to_be_sv</code></td>
<td>string</td>
<td>optional</td>
<td>An example field</td>
</tr>
</tbody>
</table>
<!-- END_a6a10ba125c19027456c678b8fbc0e58 -->
<h1>FAQ</h1>
<!-- START_25c8f8a17a9411876085853a3b9015b7 -->
<h2>Get all FAQs</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/faq" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/faq"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "title": "dsfdsf",
        "keywords": [
            "Fdf"
        ],
        "view_count": 0
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/faq</code></p>
<!-- END_25c8f8a17a9411876085853a3b9015b7 -->
<!-- START_9a955ed0f1eaa4dd4d3e07f65e62c468 -->
<h2>Create an FAQ</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/faq" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"title":"How to logout","body":"You just click logout","role_id":10,"keywords":["Authentication","User"]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/faq"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "title": "How to logout",
    "body": "You just click logout",
    "role_id": 10,
    "keywords": [
        "Authentication",
        "User"
    ]
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 2,
        "title": "How to logout",
        "keywords": [
            "Authentication",
            "User"
        ],
        "body": "You just click logout",
        "view_count": 0,
        "role_id": 10
    },
    "message": "Faq created"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/faq</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>title</code></td>
<td>string</td>
<td>required</td>
<td>The FAQ's title</td>
</tr>
<tr>
<td><code>body</code></td>
<td>string</td>
<td>required</td>
<td>The FAQ's content</td>
</tr>
<tr>
<td><code>role_id</code></td>
<td>integer</td>
<td>optional</td>
<td>The FAQ's required minimum role to view</td>
</tr>
<tr>
<td><code>keywords</code></td>
<td>array</td>
<td>required</td>
<td>The FAQ's keywords</td>
</tr>
<tr>
<td><code>keywords[0]</code></td>
<td>string</td>
<td>optional</td>
<td>A keyword</td>
</tr>
<tr>
<td><code>keywords[1]</code></td>
<td>string</td>
<td>optional</td>
<td>A keyword</td>
</tr>
</tbody>
</table>
<!-- END_9a955ed0f1eaa4dd4d3e07f65e62c468 -->
<!-- START_02a474bbf51e7ce8e35a73cec4877094 -->
<h2>Get an FAQ entry</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/faq/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/faq/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "title": "dsfdsf",
    "keywords": [
        "Fdf"
    ],
    "body": "fd",
    "view_count": 1,
    "role_id": null,
    "role": null
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/faq/{faq}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>faq</code></td>
<td>required</td>
<td>The FAQ's id</td>
</tr>
</tbody>
</table>
<!-- END_02a474bbf51e7ce8e35a73cec4877094 -->
<!-- START_9894be78b791ba8d6ca29155ab18e760 -->
<h2>Update an FAQ</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/faq/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"title":"How to logout","body":"You just click logout","role_id":10,"keywords":["Authentication","User"]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/faq/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "title": "How to logout",
    "body": "You just click logout",
    "role_id": 10,
    "keywords": [
        "Authentication",
        "User"
    ]
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 1,
        "title": "How to logout",
        "keywords": [
            "Authentication",
            "User"
        ],
        "body": "You just click logout",
        "view_count": 0,
        "role_id": 10,
        "role": {
            "id": 10,
            "name": "sv",
            "description": "Is associated for conferences as SV"
        }
    },
    "message": "Faq updated"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/faq/{faq}</code></p>
<p><code>PATCH api/v1/faq/{faq}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>faq</code></td>
<td>required</td>
<td>The FAQ's id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>title</code></td>
<td>string</td>
<td>required</td>
<td>The FAQ's title</td>
</tr>
<tr>
<td><code>body</code></td>
<td>string</td>
<td>required</td>
<td>The FAQ's content</td>
</tr>
<tr>
<td><code>role_id</code></td>
<td>integer</td>
<td>optional</td>
<td>The FAQ's required minimum role to view</td>
</tr>
<tr>
<td><code>keywords</code></td>
<td>array</td>
<td>required</td>
<td>The FAQ's keywords</td>
</tr>
<tr>
<td><code>keywords[0]</code></td>
<td>string</td>
<td>optional</td>
<td>A keyword</td>
</tr>
<tr>
<td><code>keywords[1]</code></td>
<td>string</td>
<td>optional</td>
<td>A keyword</td>
</tr>
</tbody>
</table>
<!-- END_9894be78b791ba8d6ca29155ab18e760 -->
<!-- START_9b832ae5e450eab7da9bad731950513e -->
<h2>Remove an FAQ</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/faq/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/faq/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Faq removed"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/faq/{faq}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>faq</code></td>
<td>required</td>
<td>The FAQ's id</td>
</tr>
</tbody>
</table>
<!-- END_9b832ae5e450eab7da9bad731950513e -->
<h1>Generic Resources</h1>
<!-- START_25b8af9b90e055d9406bbfbb4b017c94 -->
<h2>Get all locales</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/locale" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/locale"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "code": "af",
        "name": "Afrikaans"
    },
    {
        "id": 2,
        "code": "sq",
        "name": "Albanian"
    },
    {
        "id": 3,
        "code": "ar",
        "name": "Arabic"
    },
    {
        "id": 127,
        "code": "yo",
        "name": "Yoruba Nigeria"
    },
    {
        "id": 128,
        "code": "ss",
        "name": "siSwati"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/locale</code></p>
<!-- END_25b8af9b90e055d9406bbfbb4b017c94 -->
<!-- START_aaaefa3727cedbf0d8299c07225811af -->
<h2>Get all timezones</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/timezone" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/timezone"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "Africa\/Abidjan"
    },
    {
        "id": 2,
        "name": "Africa\/Accra"
    },
    {
        "id": 3,
        "name": "Africa\/Algiers"
    },
    {
        "id": 4,
        "name": "Africa\/Bissau"
    },
    {
        "id": 5,
        "name": "Africa\/Cairo"
    },
    {
        "id": 6,
        "name": "Africa\/Casablanca"
    },
    {
        "id": 7,
        "name": "Africa\/Ceuta"
    },
    {
        "id": 8,
        "name": "Africa\/El_Aaiun"
    },
    {
        "id": 9,
        "name": "Africa\/Johannesburg"
    },
    {
        "id": 10,
        "name": "Africa\/Juba"
    },
    {
        "id": 11,
        "name": "Africa\/Khartoum"
    },
    {
        "id": 12,
        "name": "Africa\/Lagos"
    },
    {
        "id": 13,
        "name": "Africa\/Maputo"
    },
    {
        "id": 14,
        "name": "Africa\/Monrovia"
    },
    {
        "id": 15,
        "name": "Africa\/Nairobi"
    },
    {
        "id": 16,
        "name": "Africa\/Ndjamena"
    },
    {
        "id": 17,
        "name": "Africa\/Sao_Tome"
    },
    {
        "id": 18,
        "name": "Africa\/Tripoli"
    },
    {
        "id": 19,
        "name": "Africa\/Tunis"
    },
    {
        "id": 20,
        "name": "Africa\/Windhoek"
    },
    {
        "id": 21,
        "name": "America\/Adak"
    },
    {
        "id": 22,
        "name": "America\/Anchorage"
    },
    {
        "id": 23,
        "name": "America\/Araguaina"
    },
    {
        "id": 24,
        "name": "America\/Argentina\/Buenos_Aires"
    },
    {
        "id": 25,
        "name": "America\/Argentina\/Catamarca"
    },
    {
        "id": 26,
        "name": "America\/Argentina\/Cordoba"
    },
    {
        "id": 27,
        "name": "America\/Argentina\/Jujuy"
    },
    {
        "id": 28,
        "name": "America\/Argentina\/La_Rioja"
    },
    {
        "id": 29,
        "name": "America\/Argentina\/Mendoza"
    },
    {
        "id": 30,
        "name": "America\/Argentina\/Rio_Gallegos"
    },
    {
        "id": 31,
        "name": "America\/Argentina\/Salta"
    },
    {
        "id": 32,
        "name": "America\/Argentina\/San_Juan"
    },
    {
        "id": 33,
        "name": "America\/Argentina\/San_Luis"
    },
    {
        "id": 34,
        "name": "America\/Argentina\/Tucuman"
    },
    {
        "id": 35,
        "name": "America\/Argentina\/Ushuaia"
    },
    {
        "id": 36,
        "name": "America\/Asuncion"
    },
    {
        "id": 37,
        "name": "America\/Atikokan"
    },
    {
        "id": 38,
        "name": "America\/Bahia"
    },
    {
        "id": 39,
        "name": "America\/Bahia_Banderas"
    },
    {
        "id": 40,
        "name": "America\/Barbados"
    },
    {
        "id": 41,
        "name": "America\/Belem"
    },
    {
        "id": 42,
        "name": "America\/Belize"
    },
    {
        "id": 43,
        "name": "America\/Blanc-Sablon"
    },
    {
        "id": 44,
        "name": "America\/Boa_Vista"
    },
    {
        "id": 45,
        "name": "America\/Bogota"
    },
    {
        "id": 46,
        "name": "America\/Boise"
    },
    {
        "id": 47,
        "name": "America\/Cambridge_Bay"
    },
    {
        "id": 48,
        "name": "America\/Campo_Grande"
    },
    {
        "id": 49,
        "name": "America\/Cancun"
    },
    {
        "id": 50,
        "name": "America\/Caracas"
    },
    {
        "id": 51,
        "name": "America\/Cayenne"
    },
    {
        "id": 52,
        "name": "America\/Chicago"
    },
    {
        "id": 53,
        "name": "America\/Chihuahua"
    },
    {
        "id": 54,
        "name": "America\/Costa_Rica"
    },
    {
        "id": 55,
        "name": "America\/Creston"
    },
    {
        "id": 56,
        "name": "America\/Cuiaba"
    },
    {
        "id": 57,
        "name": "America\/Curacao"
    },
    {
        "id": 58,
        "name": "America\/Danmarkshavn"
    },
    {
        "id": 59,
        "name": "America\/Dawson"
    },
    {
        "id": 60,
        "name": "America\/Dawson_Creek"
    },
    {
        "id": 61,
        "name": "America\/Denver"
    },
    {
        "id": 62,
        "name": "America\/Detroit"
    },
    {
        "id": 63,
        "name": "America\/Edmonton"
    },
    {
        "id": 64,
        "name": "America\/Eirunepe"
    },
    {
        "id": 65,
        "name": "America\/El_Salvador"
    },
    {
        "id": 66,
        "name": "America\/Fort_Nelson"
    },
    {
        "id": 67,
        "name": "America\/Fortaleza"
    },
    {
        "id": 68,
        "name": "America\/Glace_Bay"
    },
    {
        "id": 69,
        "name": "America\/Godthab"
    },
    {
        "id": 70,
        "name": "America\/Goose_Bay"
    },
    {
        "id": 71,
        "name": "America\/Grand_Turk"
    },
    {
        "id": 72,
        "name": "America\/Guatemala"
    },
    {
        "id": 73,
        "name": "America\/Guayaquil"
    },
    {
        "id": 74,
        "name": "America\/Guyana"
    },
    {
        "id": 75,
        "name": "America\/Halifax"
    },
    {
        "id": 76,
        "name": "America\/Havana"
    },
    {
        "id": 77,
        "name": "America\/Hermosillo"
    },
    {
        "id": 78,
        "name": "America\/Indiana\/Indianapolis"
    },
    {
        "id": 79,
        "name": "America\/Indiana\/Knox"
    },
    {
        "id": 80,
        "name": "America\/Indiana\/Marengo"
    },
    {
        "id": 81,
        "name": "America\/Indiana\/Petersburg"
    },
    {
        "id": 82,
        "name": "America\/Indiana\/Tell_City"
    },
    {
        "id": 83,
        "name": "America\/Indiana\/Vevay"
    },
    {
        "id": 84,
        "name": "America\/Indiana\/Vincennes"
    },
    {
        "id": 85,
        "name": "America\/Indiana\/Winamac"
    },
    {
        "id": 86,
        "name": "America\/Inuvik"
    },
    {
        "id": 87,
        "name": "America\/Iqaluit"
    },
    {
        "id": 88,
        "name": "America\/Jamaica"
    },
    {
        "id": 89,
        "name": "America\/Juneau"
    },
    {
        "id": 90,
        "name": "America\/Kentucky\/Louisville"
    },
    {
        "id": 91,
        "name": "America\/Kentucky\/Monticello"
    },
    {
        "id": 92,
        "name": "America\/La_Paz"
    },
    {
        "id": 93,
        "name": "America\/Lima"
    },
    {
        "id": 94,
        "name": "America\/Los_Angeles"
    },
    {
        "id": 95,
        "name": "America\/Maceio"
    },
    {
        "id": 96,
        "name": "America\/Managua"
    },
    {
        "id": 97,
        "name": "America\/Manaus"
    },
    {
        "id": 98,
        "name": "America\/Martinique"
    },
    {
        "id": 99,
        "name": "America\/Matamoros"
    },
    {
        "id": 100,
        "name": "America\/Mazatlan"
    },
    {
        "id": 101,
        "name": "America\/Menominee"
    },
    {
        "id": 102,
        "name": "America\/Merida"
    },
    {
        "id": 103,
        "name": "America\/Metlakatla"
    },
    {
        "id": 104,
        "name": "America\/Mexico_City"
    },
    {
        "id": 105,
        "name": "America\/Miquelon"
    },
    {
        "id": 106,
        "name": "America\/Moncton"
    },
    {
        "id": 107,
        "name": "America\/Monterrey"
    },
    {
        "id": 108,
        "name": "America\/Montevideo"
    },
    {
        "id": 109,
        "name": "America\/Nassau"
    },
    {
        "id": 110,
        "name": "America\/New_York"
    },
    {
        "id": 111,
        "name": "America\/Nipigon"
    },
    {
        "id": 112,
        "name": "America\/Nome"
    },
    {
        "id": 113,
        "name": "America\/Noronha"
    },
    {
        "id": 114,
        "name": "America\/North_Dakota\/Beulah"
    },
    {
        "id": 115,
        "name": "America\/North_Dakota\/Center"
    },
    {
        "id": 116,
        "name": "America\/North_Dakota\/New_Salem"
    },
    {
        "id": 117,
        "name": "America\/Ojinaga"
    },
    {
        "id": 118,
        "name": "America\/Panama"
    },
    {
        "id": 119,
        "name": "America\/Pangnirtung"
    },
    {
        "id": 120,
        "name": "America\/Paramaribo"
    },
    {
        "id": 121,
        "name": "America\/Phoenix"
    },
    {
        "id": 122,
        "name": "America\/Port-au-Prince"
    },
    {
        "id": 123,
        "name": "America\/Port_of_Spain"
    },
    {
        "id": 124,
        "name": "America\/Porto_Velho"
    },
    {
        "id": 125,
        "name": "America\/Puerto_Rico"
    },
    {
        "id": 126,
        "name": "America\/Punta_Arenas"
    },
    {
        "id": 127,
        "name": "America\/Rainy_River"
    },
    {
        "id": 128,
        "name": "America\/Rankin_Inlet"
    },
    {
        "id": 129,
        "name": "America\/Recife"
    },
    {
        "id": 130,
        "name": "America\/Regina"
    },
    {
        "id": 131,
        "name": "America\/Resolute"
    },
    {
        "id": 132,
        "name": "America\/Rio_Branco"
    },
    {
        "id": 133,
        "name": "America\/Santarem"
    },
    {
        "id": 134,
        "name": "America\/Santiago"
    },
    {
        "id": 135,
        "name": "America\/Santo_Domingo"
    },
    {
        "id": 136,
        "name": "America\/Sao_Paulo"
    },
    {
        "id": 137,
        "name": "America\/Scoresbysund"
    },
    {
        "id": 138,
        "name": "America\/Sitka"
    },
    {
        "id": 139,
        "name": "America\/St_Johns"
    },
    {
        "id": 140,
        "name": "America\/Swift_Current"
    },
    {
        "id": 141,
        "name": "America\/Tegucigalpa"
    },
    {
        "id": 142,
        "name": "America\/Thule"
    },
    {
        "id": 143,
        "name": "America\/Thunder_Bay"
    },
    {
        "id": 144,
        "name": "America\/Tijuana"
    },
    {
        "id": 145,
        "name": "America\/Toronto"
    },
    {
        "id": 146,
        "name": "America\/Vancouver"
    },
    {
        "id": 147,
        "name": "America\/Whitehorse"
    },
    {
        "id": 148,
        "name": "America\/Winnipeg"
    },
    {
        "id": 149,
        "name": "America\/Yakutat"
    },
    {
        "id": 150,
        "name": "America\/Yellowknife"
    },
    {
        "id": 151,
        "name": "Antarctica\/Casey"
    },
    {
        "id": 152,
        "name": "Antarctica\/Davis"
    },
    {
        "id": 153,
        "name": "Antarctica\/DumontDUrville"
    },
    {
        "id": 154,
        "name": "Antarctica\/Macquarie"
    },
    {
        "id": 155,
        "name": "Antarctica\/Mawson"
    },
    {
        "id": 156,
        "name": "Antarctica\/Palmer"
    },
    {
        "id": 157,
        "name": "Antarctica\/Rothera"
    },
    {
        "id": 158,
        "name": "Antarctica\/Syowa"
    },
    {
        "id": 159,
        "name": "Antarctica\/Troll"
    },
    {
        "id": 160,
        "name": "Antarctica\/Vostok"
    },
    {
        "id": 161,
        "name": "Asia\/Almaty"
    },
    {
        "id": 162,
        "name": "Asia\/Amman"
    },
    {
        "id": 163,
        "name": "Asia\/Anadyr"
    },
    {
        "id": 164,
        "name": "Asia\/Aqtau"
    },
    {
        "id": 165,
        "name": "Asia\/Aqtobe"
    },
    {
        "id": 166,
        "name": "Asia\/Ashgabat"
    },
    {
        "id": 167,
        "name": "Asia\/Atyrau"
    },
    {
        "id": 168,
        "name": "Asia\/Baghdad"
    },
    {
        "id": 169,
        "name": "Asia\/Baku"
    },
    {
        "id": 170,
        "name": "Asia\/Bangkok"
    },
    {
        "id": 171,
        "name": "Asia\/Barnaul"
    },
    {
        "id": 172,
        "name": "Asia\/Beirut"
    },
    {
        "id": 173,
        "name": "Asia\/Bishkek"
    },
    {
        "id": 174,
        "name": "Asia\/Brunei"
    },
    {
        "id": 175,
        "name": "Asia\/Chita"
    },
    {
        "id": 176,
        "name": "Asia\/Choibalsan"
    },
    {
        "id": 177,
        "name": "Asia\/Colombo"
    },
    {
        "id": 178,
        "name": "Asia\/Damascus"
    },
    {
        "id": 179,
        "name": "Asia\/Dhaka"
    },
    {
        "id": 180,
        "name": "Asia\/Dili"
    },
    {
        "id": 181,
        "name": "Asia\/Dubai"
    },
    {
        "id": 182,
        "name": "Asia\/Dushanbe"
    },
    {
        "id": 183,
        "name": "Asia\/Famagusta"
    },
    {
        "id": 184,
        "name": "Asia\/Gaza"
    },
    {
        "id": 185,
        "name": "Asia\/Hebron"
    },
    {
        "id": 186,
        "name": "Asia\/Ho_Chi_Minh"
    },
    {
        "id": 187,
        "name": "Asia\/Hong_Kong"
    },
    {
        "id": 188,
        "name": "Asia\/Hovd"
    },
    {
        "id": 189,
        "name": "Asia\/Irkutsk"
    },
    {
        "id": 190,
        "name": "Asia\/Jakarta"
    },
    {
        "id": 191,
        "name": "Asia\/Jayapura"
    },
    {
        "id": 192,
        "name": "Asia\/Jerusalem"
    },
    {
        "id": 193,
        "name": "Asia\/Kabul"
    },
    {
        "id": 194,
        "name": "Asia\/Kamchatka"
    },
    {
        "id": 195,
        "name": "Asia\/Karachi"
    },
    {
        "id": 196,
        "name": "Asia\/Kathmandu"
    },
    {
        "id": 197,
        "name": "Asia\/Khandyga"
    },
    {
        "id": 198,
        "name": "Asia\/Kolkata"
    },
    {
        "id": 199,
        "name": "Asia\/Krasnoyarsk"
    },
    {
        "id": 200,
        "name": "Asia\/Kuala_Lumpur"
    },
    {
        "id": 201,
        "name": "Asia\/Kuching"
    },
    {
        "id": 202,
        "name": "Asia\/Macau"
    },
    {
        "id": 203,
        "name": "Asia\/Magadan"
    },
    {
        "id": 204,
        "name": "Asia\/Makassar"
    },
    {
        "id": 205,
        "name": "Asia\/Manila"
    },
    {
        "id": 206,
        "name": "Asia\/Nicosia"
    },
    {
        "id": 207,
        "name": "Asia\/Novokuznetsk"
    },
    {
        "id": 208,
        "name": "Asia\/Novosibirsk"
    },
    {
        "id": 209,
        "name": "Asia\/Omsk"
    },
    {
        "id": 210,
        "name": "Asia\/Oral"
    },
    {
        "id": 211,
        "name": "Asia\/Pontianak"
    },
    {
        "id": 212,
        "name": "Asia\/Pyongyang"
    },
    {
        "id": 213,
        "name": "Asia\/Qatar"
    },
    {
        "id": 214,
        "name": "Asia\/Qostanay"
    },
    {
        "id": 215,
        "name": "Asia\/Qyzylorda"
    },
    {
        "id": 216,
        "name": "Asia\/Riyadh"
    },
    {
        "id": 217,
        "name": "Asia\/Sakhalin"
    },
    {
        "id": 218,
        "name": "Asia\/Samarkand"
    },
    {
        "id": 219,
        "name": "Asia\/Seoul"
    },
    {
        "id": 220,
        "name": "Asia\/Shanghai"
    },
    {
        "id": 221,
        "name": "Asia\/Singapore"
    },
    {
        "id": 222,
        "name": "Asia\/Srednekolymsk"
    },
    {
        "id": 223,
        "name": "Asia\/Taipei"
    },
    {
        "id": 224,
        "name": "Asia\/Tashkent"
    },
    {
        "id": 225,
        "name": "Asia\/Tbilisi"
    },
    {
        "id": 226,
        "name": "Asia\/Tehran"
    },
    {
        "id": 227,
        "name": "Asia\/Thimphu"
    },
    {
        "id": 228,
        "name": "Asia\/Tokyo"
    },
    {
        "id": 229,
        "name": "Asia\/Tomsk"
    },
    {
        "id": 230,
        "name": "Asia\/Ulaanbaatar"
    },
    {
        "id": 231,
        "name": "Asia\/Urumqi"
    },
    {
        "id": 232,
        "name": "Asia\/Ust-Nera"
    },
    {
        "id": 233,
        "name": "Asia\/Vladivostok"
    },
    {
        "id": 234,
        "name": "Asia\/Yakutsk"
    },
    {
        "id": 235,
        "name": "Asia\/Yangon"
    },
    {
        "id": 236,
        "name": "Asia\/Yekaterinburg"
    },
    {
        "id": 237,
        "name": "Asia\/Yerevan"
    },
    {
        "id": 238,
        "name": "Atlantic\/Azores"
    },
    {
        "id": 239,
        "name": "Atlantic\/Bermuda"
    },
    {
        "id": 240,
        "name": "Atlantic\/Canary"
    },
    {
        "id": 241,
        "name": "Atlantic\/Cape_Verde"
    },
    {
        "id": 242,
        "name": "Atlantic\/Faroe"
    },
    {
        "id": 243,
        "name": "Atlantic\/Madeira"
    },
    {
        "id": 244,
        "name": "Atlantic\/Reykjavik"
    },
    {
        "id": 245,
        "name": "Atlantic\/South_Georgia"
    },
    {
        "id": 246,
        "name": "Atlantic\/Stanley"
    },
    {
        "id": 247,
        "name": "Australia\/Adelaide"
    },
    {
        "id": 248,
        "name": "Australia\/Brisbane"
    },
    {
        "id": 249,
        "name": "Australia\/Broken_Hill"
    },
    {
        "id": 250,
        "name": "Australia\/Currie"
    },
    {
        "id": 251,
        "name": "Australia\/Darwin"
    },
    {
        "id": 252,
        "name": "Australia\/Eucla"
    },
    {
        "id": 253,
        "name": "Australia\/Hobart"
    },
    {
        "id": 254,
        "name": "Australia\/Lindeman"
    },
    {
        "id": 255,
        "name": "Australia\/Lord_Howe"
    },
    {
        "id": 256,
        "name": "Australia\/Melbourne"
    },
    {
        "id": 257,
        "name": "Australia\/Perth"
    },
    {
        "id": 258,
        "name": "Australia\/Sydney"
    },
    {
        "id": 259,
        "name": "CET"
    },
    {
        "id": 260,
        "name": "CST6CDT"
    },
    {
        "id": 261,
        "name": "EET"
    },
    {
        "id": 262,
        "name": "EST"
    },
    {
        "id": 263,
        "name": "EST5EDT"
    },
    {
        "id": 264,
        "name": "Etc\/GMT"
    },
    {
        "id": 265,
        "name": "Etc\/GMT+1"
    },
    {
        "id": 266,
        "name": "Etc\/GMT+10"
    },
    {
        "id": 267,
        "name": "Etc\/GMT+11"
    },
    {
        "id": 268,
        "name": "Etc\/GMT+12"
    },
    {
        "id": 269,
        "name": "Etc\/GMT+2"
    },
    {
        "id": 270,
        "name": "Etc\/GMT+3"
    },
    {
        "id": 271,
        "name": "Etc\/GMT+4"
    },
    {
        "id": 272,
        "name": "Etc\/GMT+5"
    },
    {
        "id": 273,
        "name": "Etc\/GMT+6"
    },
    {
        "id": 274,
        "name": "Etc\/GMT+7"
    },
    {
        "id": 275,
        "name": "Etc\/GMT+8"
    },
    {
        "id": 276,
        "name": "Etc\/GMT+9"
    },
    {
        "id": 277,
        "name": "Etc\/GMT-1"
    },
    {
        "id": 278,
        "name": "Etc\/GMT-10"
    },
    {
        "id": 279,
        "name": "Etc\/GMT-11"
    },
    {
        "id": 280,
        "name": "Etc\/GMT-12"
    },
    {
        "id": 281,
        "name": "Etc\/GMT-13"
    },
    {
        "id": 282,
        "name": "Etc\/GMT-14"
    },
    {
        "id": 283,
        "name": "Etc\/GMT-2"
    },
    {
        "id": 284,
        "name": "Etc\/GMT-3"
    },
    {
        "id": 285,
        "name": "Etc\/GMT-4"
    },
    {
        "id": 286,
        "name": "Etc\/GMT-5"
    },
    {
        "id": 287,
        "name": "Etc\/GMT-6"
    },
    {
        "id": 288,
        "name": "Etc\/GMT-7"
    },
    {
        "id": 289,
        "name": "Etc\/GMT-8"
    },
    {
        "id": 290,
        "name": "Etc\/GMT-9"
    },
    {
        "id": 291,
        "name": "Etc\/UTC"
    },
    {
        "id": 292,
        "name": "Europe\/Amsterdam"
    },
    {
        "id": 293,
        "name": "Europe\/Andorra"
    },
    {
        "id": 294,
        "name": "Europe\/Astrakhan"
    },
    {
        "id": 295,
        "name": "Europe\/Athens"
    },
    {
        "id": 296,
        "name": "Europe\/Belgrade"
    },
    {
        "id": 297,
        "name": "Europe\/Berlin"
    },
    {
        "id": 298,
        "name": "Europe\/Brussels"
    },
    {
        "id": 299,
        "name": "Europe\/Bucharest"
    },
    {
        "id": 300,
        "name": "Europe\/Budapest"
    },
    {
        "id": 301,
        "name": "Europe\/Chisinau"
    },
    {
        "id": 302,
        "name": "Europe\/Copenhagen"
    },
    {
        "id": 303,
        "name": "Europe\/Dublin"
    },
    {
        "id": 304,
        "name": "Europe\/Gibraltar"
    },
    {
        "id": 305,
        "name": "Europe\/Helsinki"
    },
    {
        "id": 306,
        "name": "Europe\/Istanbul"
    },
    {
        "id": 307,
        "name": "Europe\/Kaliningrad"
    },
    {
        "id": 308,
        "name": "Europe\/Kiev"
    },
    {
        "id": 309,
        "name": "Europe\/Kirov"
    },
    {
        "id": 310,
        "name": "Europe\/Lisbon"
    },
    {
        "id": 311,
        "name": "Europe\/London"
    },
    {
        "id": 312,
        "name": "Europe\/Luxembourg"
    },
    {
        "id": 313,
        "name": "Europe\/Madrid"
    },
    {
        "id": 314,
        "name": "Europe\/Malta"
    },
    {
        "id": 315,
        "name": "Europe\/Minsk"
    },
    {
        "id": 316,
        "name": "Europe\/Monaco"
    },
    {
        "id": 317,
        "name": "Europe\/Moscow"
    },
    {
        "id": 318,
        "name": "Europe\/Oslo"
    },
    {
        "id": 319,
        "name": "Europe\/Paris"
    },
    {
        "id": 320,
        "name": "Europe\/Prague"
    },
    {
        "id": 321,
        "name": "Europe\/Riga"
    },
    {
        "id": 322,
        "name": "Europe\/Rome"
    },
    {
        "id": 323,
        "name": "Europe\/Samara"
    },
    {
        "id": 324,
        "name": "Europe\/Saratov"
    },
    {
        "id": 325,
        "name": "Europe\/Simferopol"
    },
    {
        "id": 326,
        "name": "Europe\/Sofia"
    },
    {
        "id": 327,
        "name": "Europe\/Stockholm"
    },
    {
        "id": 328,
        "name": "Europe\/Tallinn"
    },
    {
        "id": 329,
        "name": "Europe\/Tirane"
    },
    {
        "id": 330,
        "name": "Europe\/Ulyanovsk"
    },
    {
        "id": 331,
        "name": "Europe\/Uzhgorod"
    },
    {
        "id": 332,
        "name": "Europe\/Vienna"
    },
    {
        "id": 333,
        "name": "Europe\/Vilnius"
    },
    {
        "id": 334,
        "name": "Europe\/Volgograd"
    },
    {
        "id": 335,
        "name": "Europe\/Warsaw"
    },
    {
        "id": 336,
        "name": "Europe\/Zaporozhye"
    },
    {
        "id": 337,
        "name": "Europe\/Zurich"
    },
    {
        "id": 338,
        "name": "HST"
    },
    {
        "id": 339,
        "name": "Indian\/Chagos"
    },
    {
        "id": 340,
        "name": "Indian\/Christmas"
    },
    {
        "id": 341,
        "name": "Indian\/Cocos"
    },
    {
        "id": 342,
        "name": "Indian\/Kerguelen"
    },
    {
        "id": 343,
        "name": "Indian\/Mahe"
    },
    {
        "id": 344,
        "name": "Indian\/Maldives"
    },
    {
        "id": 345,
        "name": "Indian\/Mauritius"
    },
    {
        "id": 346,
        "name": "Indian\/Reunion"
    },
    {
        "id": 347,
        "name": "MET"
    },
    {
        "id": 348,
        "name": "MST"
    },
    {
        "id": 349,
        "name": "MST7MDT"
    },
    {
        "id": 350,
        "name": "PST8PDT"
    },
    {
        "id": 351,
        "name": "Pacific\/Apia"
    },
    {
        "id": 352,
        "name": "Pacific\/Auckland"
    },
    {
        "id": 353,
        "name": "Pacific\/Bougainville"
    },
    {
        "id": 354,
        "name": "Pacific\/Chatham"
    },
    {
        "id": 355,
        "name": "Pacific\/Chuuk"
    },
    {
        "id": 356,
        "name": "Pacific\/Easter"
    },
    {
        "id": 357,
        "name": "Pacific\/Efate"
    },
    {
        "id": 358,
        "name": "Pacific\/Enderbury"
    },
    {
        "id": 359,
        "name": "Pacific\/Fakaofo"
    },
    {
        "id": 360,
        "name": "Pacific\/Fiji"
    },
    {
        "id": 361,
        "name": "Pacific\/Funafuti"
    },
    {
        "id": 362,
        "name": "Pacific\/Galapagos"
    },
    {
        "id": 363,
        "name": "Pacific\/Gambier"
    },
    {
        "id": 364,
        "name": "Pacific\/Guadalcanal"
    },
    {
        "id": 365,
        "name": "Pacific\/Guam"
    },
    {
        "id": 366,
        "name": "Pacific\/Honolulu"
    },
    {
        "id": 367,
        "name": "Pacific\/Kiritimati"
    },
    {
        "id": 368,
        "name": "Pacific\/Kosrae"
    },
    {
        "id": 369,
        "name": "Pacific\/Kwajalein"
    },
    {
        "id": 370,
        "name": "Pacific\/Majuro"
    },
    {
        "id": 371,
        "name": "Pacific\/Marquesas"
    },
    {
        "id": 372,
        "name": "Pacific\/Nauru"
    },
    {
        "id": 373,
        "name": "Pacific\/Niue"
    },
    {
        "id": 374,
        "name": "Pacific\/Norfolk"
    },
    {
        "id": 375,
        "name": "Pacific\/Noumea"
    },
    {
        "id": 376,
        "name": "Pacific\/Pago_Pago"
    },
    {
        "id": 377,
        "name": "Pacific\/Palau"
    },
    {
        "id": 378,
        "name": "Pacific\/Pitcairn"
    },
    {
        "id": 379,
        "name": "Pacific\/Pohnpei"
    },
    {
        "id": 380,
        "name": "Pacific\/Port_Moresby"
    },
    {
        "id": 381,
        "name": "Pacific\/Rarotonga"
    },
    {
        "id": 382,
        "name": "Pacific\/Tahiti"
    },
    {
        "id": 383,
        "name": "Pacific\/Tarawa"
    },
    {
        "id": 384,
        "name": "Pacific\/Tongatapu"
    },
    {
        "id": 385,
        "name": "Pacific\/Wake"
    },
    {
        "id": 386,
        "name": "Pacific\/Wallis"
    },
    {
        "id": 387,
        "name": "WET"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/timezone</code></p>
<!-- END_aaaefa3727cedbf0d8299c07225811af -->
<!-- START_eb45f6491172f73ce8b9bab81dc33af2 -->
<h2>Get all T-Shirts</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/shirt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/shirt"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "cut": "Straight",
        "size": "S"
    },
    {
        "id": 2,
        "cut": "Straight",
        "size": "M"
    },
    {
        "id": 3,
        "cut": "Straight",
        "size": "L"
    },
    {
        "id": 4,
        "cut": "Straight",
        "size": "XL"
    },
    {
        "id": 5,
        "cut": "Straight",
        "size": "XXL"
    },
    {
        "id": 6,
        "cut": "Straight",
        "size": "XXXL"
    },
    {
        "id": 11,
        "cut": "Tailored",
        "size": "XS"
    },
    {
        "id": 12,
        "cut": "Tailored",
        "size": "S"
    },
    {
        "id": 13,
        "cut": "Tailored",
        "size": "M"
    },
    {
        "id": 14,
        "cut": "Tailored",
        "size": "L"
    },
    {
        "id": 15,
        "cut": "Tailored",
        "size": "XL"
    },
    {
        "id": 16,
        "cut": "Tailored",
        "size": "XXL"
    },
    {
        "id": 17,
        "cut": "Tailored",
        "size": "XXXL"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/shirt</code></p>
<!-- END_eb45f6491172f73ce8b9bab81dc33af2 -->
<!-- START_de3557d85f75096c1b6b8ecf3db1f215 -->
<h2>Get all degrees</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/degree" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/degree"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "Bachelor"
    },
    {
        "id": 2,
        "name": "Master"
    },
    {
        "id": 3,
        "name": "PhD - 1st year"
    },
    {
        "id": 4,
        "name": "PhD - 2nd year"
    },
    {
        "id": 5,
        "name": "PhD - 3rd year"
    },
    {
        "id": 6,
        "name": "PhD - 4th year"
    },
    {
        "id": 7,
        "name": "PhD - &gt;5 years"
    },
    {
        "id": 8,
        "name": "other"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/degree</code></p>
<!-- END_de3557d85f75096c1b6b8ecf3db1f215 -->
<!-- START_1679487bc160b7e206461ed929d8f8f0 -->
<h2>Get all countries</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/country" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/country"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "Afghanistan"
    },
    {
        "id": 2,
        "name": "Aland Islands"
    },
    {
        "id": 3,
        "name": "Albania"
    },
    {
        "id": 4,
        "name": "Algeria"
    },
    {
        "id": 5,
        "name": "American Samoa"
    },
    {
        "id": 6,
        "name": "Andorra"
    },
    {
        "id": 7,
        "name": "Angola"
    },
    {
        "id": 8,
        "name": "Anguilla"
    },
    {
        "id": 9,
        "name": "Antarctica"
    },
    {
        "id": 10,
        "name": "Antigua And Barbuda"
    },
    {
        "id": 11,
        "name": "Argentina"
    },
    {
        "id": 12,
        "name": "Armenia"
    },
    {
        "id": 13,
        "name": "Aruba"
    },
    {
        "id": 14,
        "name": "Australia"
    },
    {
        "id": 15,
        "name": "Austria"
    },
    {
        "id": 16,
        "name": "Azerbaijan"
    },
    {
        "id": 17,
        "name": "Bahamas The"
    },
    {
        "id": 18,
        "name": "Bahrain"
    },
    {
        "id": 19,
        "name": "Bangladesh"
    },
    {
        "id": 20,
        "name": "Barbados"
    },
    {
        "id": 21,
        "name": "Belarus"
    },
    {
        "id": 22,
        "name": "Belgium"
    },
    {
        "id": 23,
        "name": "Belize"
    },
    {
        "id": 24,
        "name": "Benin"
    },
    {
        "id": 25,
        "name": "Bermuda"
    },
    {
        "id": 26,
        "name": "Bhutan"
    },
    {
        "id": 27,
        "name": "Bolivia"
    },
    {
        "id": 28,
        "name": "Bosnia and Herzegovina"
    },
    {
        "id": 29,
        "name": "Botswana"
    },
    {
        "id": 30,
        "name": "Bouvet Island"
    },
    {
        "id": 31,
        "name": "Brazil"
    },
    {
        "id": 32,
        "name": "British Indian Ocean Territory"
    },
    {
        "id": 33,
        "name": "Brunei"
    },
    {
        "id": 34,
        "name": "Bulgaria"
    },
    {
        "id": 35,
        "name": "Burkina Faso"
    },
    {
        "id": 36,
        "name": "Burundi"
    },
    {
        "id": 37,
        "name": "Cambodia"
    },
    {
        "id": 38,
        "name": "Cameroon"
    },
    {
        "id": 39,
        "name": "Canada"
    },
    {
        "id": 40,
        "name": "Cape Verde"
    },
    {
        "id": 41,
        "name": "Cayman Islands"
    },
    {
        "id": 42,
        "name": "Central African Republic"
    },
    {
        "id": 43,
        "name": "Chad"
    },
    {
        "id": 44,
        "name": "Chile"
    },
    {
        "id": 45,
        "name": "China"
    },
    {
        "id": 46,
        "name": "Christmas Island"
    },
    {
        "id": 47,
        "name": "Cocos (Keeling) Islands"
    },
    {
        "id": 48,
        "name": "Colombia"
    },
    {
        "id": 49,
        "name": "Comoros"
    },
    {
        "id": 50,
        "name": "Congo"
    },
    {
        "id": 51,
        "name": "Congo The Democratic Republic Of The"
    },
    {
        "id": 52,
        "name": "Cook Islands"
    },
    {
        "id": 53,
        "name": "Costa Rica"
    },
    {
        "id": 54,
        "name": "Cote D'Ivoire (Ivory Coast)"
    },
    {
        "id": 55,
        "name": "Croatia (Hrvatska)"
    },
    {
        "id": 56,
        "name": "Cuba"
    },
    {
        "id": 57,
        "name": "Cyprus"
    },
    {
        "id": 58,
        "name": "Czech Republic"
    },
    {
        "id": 59,
        "name": "Denmark"
    },
    {
        "id": 60,
        "name": "Djibouti"
    },
    {
        "id": 61,
        "name": "Dominica"
    },
    {
        "id": 62,
        "name": "Dominican Republic"
    },
    {
        "id": 63,
        "name": "East Timor"
    },
    {
        "id": 64,
        "name": "Ecuador"
    },
    {
        "id": 65,
        "name": "Egypt"
    },
    {
        "id": 66,
        "name": "El Salvador"
    },
    {
        "id": 67,
        "name": "Equatorial Guinea"
    },
    {
        "id": 68,
        "name": "Eritrea"
    },
    {
        "id": 69,
        "name": "Estonia"
    },
    {
        "id": 70,
        "name": "Ethiopia"
    },
    {
        "id": 71,
        "name": "Falkland Islands"
    },
    {
        "id": 72,
        "name": "Faroe Islands"
    },
    {
        "id": 73,
        "name": "Fiji Islands"
    },
    {
        "id": 74,
        "name": "Finland"
    },
    {
        "id": 75,
        "name": "France"
    },
    {
        "id": 76,
        "name": "French Guiana"
    },
    {
        "id": 77,
        "name": "French Polynesia"
    },
    {
        "id": 78,
        "name": "French Southern Territories"
    },
    {
        "id": 79,
        "name": "Gabon"
    },
    {
        "id": 80,
        "name": "Gambia The"
    },
    {
        "id": 81,
        "name": "Georgia"
    },
    {
        "id": 82,
        "name": "Germany"
    },
    {
        "id": 83,
        "name": "Ghana"
    },
    {
        "id": 84,
        "name": "Gibraltar"
    },
    {
        "id": 85,
        "name": "Greece"
    },
    {
        "id": 86,
        "name": "Greenland"
    },
    {
        "id": 87,
        "name": "Grenada"
    },
    {
        "id": 88,
        "name": "Guadeloupe"
    },
    {
        "id": 89,
        "name": "Guam"
    },
    {
        "id": 90,
        "name": "Guatemala"
    },
    {
        "id": 91,
        "name": "Guernsey and Alderney"
    },
    {
        "id": 92,
        "name": "Guinea"
    },
    {
        "id": 93,
        "name": "Guinea-Bissau"
    },
    {
        "id": 94,
        "name": "Guyana"
    },
    {
        "id": 95,
        "name": "Haiti"
    },
    {
        "id": 96,
        "name": "Heard and McDonald Islands"
    },
    {
        "id": 97,
        "name": "Honduras"
    },
    {
        "id": 98,
        "name": "Hong Kong S.A.R."
    },
    {
        "id": 99,
        "name": "Hungary"
    },
    {
        "id": 100,
        "name": "Iceland"
    },
    {
        "id": 101,
        "name": "India"
    },
    {
        "id": 102,
        "name": "Indonesia"
    },
    {
        "id": 103,
        "name": "Iran"
    },
    {
        "id": 104,
        "name": "Iraq"
    },
    {
        "id": 105,
        "name": "Ireland"
    },
    {
        "id": 106,
        "name": "Israel"
    },
    {
        "id": 107,
        "name": "Italy"
    },
    {
        "id": 108,
        "name": "Jamaica"
    },
    {
        "id": 109,
        "name": "Japan"
    },
    {
        "id": 110,
        "name": "Jersey"
    },
    {
        "id": 111,
        "name": "Jordan"
    },
    {
        "id": 112,
        "name": "Kazakhstan"
    },
    {
        "id": 113,
        "name": "Kenya"
    },
    {
        "id": 114,
        "name": "Kiribati"
    },
    {
        "id": 115,
        "name": "Korea North"
    },
    {
        "id": 116,
        "name": "Korea South"
    },
    {
        "id": 117,
        "name": "Kuwait"
    },
    {
        "id": 118,
        "name": "Kyrgyzstan"
    },
    {
        "id": 119,
        "name": "Laos"
    },
    {
        "id": 120,
        "name": "Latvia"
    },
    {
        "id": 121,
        "name": "Lebanon"
    },
    {
        "id": 122,
        "name": "Lesotho"
    },
    {
        "id": 123,
        "name": "Liberia"
    },
    {
        "id": 124,
        "name": "Libya"
    },
    {
        "id": 125,
        "name": "Liechtenstein"
    },
    {
        "id": 126,
        "name": "Lithuania"
    },
    {
        "id": 127,
        "name": "Luxembourg"
    },
    {
        "id": 128,
        "name": "Macau S.A.R."
    },
    {
        "id": 129,
        "name": "Macedonia"
    },
    {
        "id": 130,
        "name": "Madagascar"
    },
    {
        "id": 131,
        "name": "Malawi"
    },
    {
        "id": 132,
        "name": "Malaysia"
    },
    {
        "id": 133,
        "name": "Maldives"
    },
    {
        "id": 134,
        "name": "Mali"
    },
    {
        "id": 135,
        "name": "Malta"
    },
    {
        "id": 136,
        "name": "Man (Isle of)"
    },
    {
        "id": 137,
        "name": "Marshall Islands"
    },
    {
        "id": 138,
        "name": "Martinique"
    },
    {
        "id": 139,
        "name": "Mauritania"
    },
    {
        "id": 140,
        "name": "Mauritius"
    },
    {
        "id": 141,
        "name": "Mayotte"
    },
    {
        "id": 142,
        "name": "Mexico"
    },
    {
        "id": 143,
        "name": "Micronesia"
    },
    {
        "id": 144,
        "name": "Moldova"
    },
    {
        "id": 145,
        "name": "Monaco"
    },
    {
        "id": 146,
        "name": "Mongolia"
    },
    {
        "id": 147,
        "name": "Montenegro"
    },
    {
        "id": 148,
        "name": "Montserrat"
    },
    {
        "id": 149,
        "name": "Morocco"
    },
    {
        "id": 150,
        "name": "Mozambique"
    },
    {
        "id": 151,
        "name": "Myanmar"
    },
    {
        "id": 152,
        "name": "Namibia"
    },
    {
        "id": 153,
        "name": "Nauru"
    },
    {
        "id": 154,
        "name": "Nepal"
    },
    {
        "id": 155,
        "name": "Netherlands Antilles"
    },
    {
        "id": 156,
        "name": "Netherlands The"
    },
    {
        "id": 157,
        "name": "New Caledonia"
    },
    {
        "id": 158,
        "name": "New Zealand"
    },
    {
        "id": 159,
        "name": "Nicaragua"
    },
    {
        "id": 160,
        "name": "Niger"
    },
    {
        "id": 161,
        "name": "Nigeria"
    },
    {
        "id": 162,
        "name": "Niue"
    },
    {
        "id": 163,
        "name": "Norfolk Island"
    },
    {
        "id": 164,
        "name": "Northern Mariana Islands"
    },
    {
        "id": 165,
        "name": "Norway"
    },
    {
        "id": 166,
        "name": "Oman"
    },
    {
        "id": 167,
        "name": "Pakistan"
    },
    {
        "id": 168,
        "name": "Palau"
    },
    {
        "id": 169,
        "name": "Palestinian Territory Occupied"
    },
    {
        "id": 170,
        "name": "Panama"
    },
    {
        "id": 171,
        "name": "Papua new Guinea"
    },
    {
        "id": 172,
        "name": "Paraguay"
    },
    {
        "id": 173,
        "name": "Peru"
    },
    {
        "id": 174,
        "name": "Philippines"
    },
    {
        "id": 175,
        "name": "Pitcairn Island"
    },
    {
        "id": 176,
        "name": "Poland"
    },
    {
        "id": 177,
        "name": "Portugal"
    },
    {
        "id": 178,
        "name": "Puerto Rico"
    },
    {
        "id": 179,
        "name": "Qatar"
    },
    {
        "id": 180,
        "name": "Reunion"
    },
    {
        "id": 181,
        "name": "Romania"
    },
    {
        "id": 182,
        "name": "Russia"
    },
    {
        "id": 183,
        "name": "Rwanda"
    },
    {
        "id": 184,
        "name": "Saint Helena"
    },
    {
        "id": 185,
        "name": "Saint Kitts And Nevis"
    },
    {
        "id": 186,
        "name": "Saint Lucia"
    },
    {
        "id": 187,
        "name": "Saint Pierre and Miquelon"
    },
    {
        "id": 188,
        "name": "Saint Vincent And The Grenadines"
    },
    {
        "id": 189,
        "name": "Saint-Barthelemy"
    },
    {
        "id": 190,
        "name": "Saint-Martin (French part)"
    },
    {
        "id": 191,
        "name": "Samoa"
    },
    {
        "id": 192,
        "name": "San Marino"
    },
    {
        "id": 193,
        "name": "Sao Tome and Principe"
    },
    {
        "id": 194,
        "name": "Saudi Arabia"
    },
    {
        "id": 195,
        "name": "Senegal"
    },
    {
        "id": 196,
        "name": "Serbia"
    },
    {
        "id": 197,
        "name": "Seychelles"
    },
    {
        "id": 198,
        "name": "Sierra Leone"
    },
    {
        "id": 199,
        "name": "Singapore"
    },
    {
        "id": 200,
        "name": "Slovakia"
    },
    {
        "id": 201,
        "name": "Slovenia"
    },
    {
        "id": 202,
        "name": "Solomon Islands"
    },
    {
        "id": 203,
        "name": "Somalia"
    },
    {
        "id": 204,
        "name": "South Africa"
    },
    {
        "id": 205,
        "name": "South Georgia"
    },
    {
        "id": 206,
        "name": "South Sudan"
    },
    {
        "id": 207,
        "name": "Spain"
    },
    {
        "id": 208,
        "name": "Sri Lanka"
    },
    {
        "id": 209,
        "name": "Sudan"
    },
    {
        "id": 210,
        "name": "Suriname"
    },
    {
        "id": 211,
        "name": "Svalbard And Jan Mayen Islands"
    },
    {
        "id": 212,
        "name": "Swaziland"
    },
    {
        "id": 213,
        "name": "Sweden"
    },
    {
        "id": 214,
        "name": "Switzerland"
    },
    {
        "id": 215,
        "name": "Syria"
    },
    {
        "id": 216,
        "name": "Taiwan"
    },
    {
        "id": 217,
        "name": "Tajikistan"
    },
    {
        "id": 218,
        "name": "Tanzania"
    },
    {
        "id": 219,
        "name": "Thailand"
    },
    {
        "id": 220,
        "name": "Togo"
    },
    {
        "id": 221,
        "name": "Tokelau"
    },
    {
        "id": 222,
        "name": "Tonga"
    },
    {
        "id": 223,
        "name": "Trinidad And Tobago"
    },
    {
        "id": 224,
        "name": "Tunisia"
    },
    {
        "id": 225,
        "name": "Turkey"
    },
    {
        "id": 226,
        "name": "Turkmenistan"
    },
    {
        "id": 227,
        "name": "Turks And Caicos Islands"
    },
    {
        "id": 228,
        "name": "Tuvalu"
    },
    {
        "id": 229,
        "name": "Uganda"
    },
    {
        "id": 230,
        "name": "Ukraine"
    },
    {
        "id": 231,
        "name": "United Arab Emirates"
    },
    {
        "id": 232,
        "name": "United Kingdom"
    },
    {
        "id": 233,
        "name": "United States"
    },
    {
        "id": 234,
        "name": "United States Minor Outlying Islands"
    },
    {
        "id": 235,
        "name": "Uruguay"
    },
    {
        "id": 236,
        "name": "Uzbekistan"
    },
    {
        "id": 237,
        "name": "Vanuatu"
    },
    {
        "id": 238,
        "name": "Vatican City State (Holy See)"
    },
    {
        "id": 239,
        "name": "Venezuela"
    },
    {
        "id": 240,
        "name": "Vietnam"
    },
    {
        "id": 241,
        "name": "Virgin Islands (British)"
    },
    {
        "id": 242,
        "name": "Virgin Islands (US)"
    },
    {
        "id": 243,
        "name": "Wallis And Futuna Islands"
    },
    {
        "id": 244,
        "name": "Western Sahara"
    },
    {
        "id": 245,
        "name": "Yemen"
    },
    {
        "id": 246,
        "name": "Zambia"
    },
    {
        "id": 247,
        "name": "Zimbabwe"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/country</code></p>
<!-- END_1679487bc160b7e206461ed929d8f8f0 -->
<!-- START_e35db8e545c70086574b63263307a7fa -->
<h2>Get all locations for a country by city name</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/country/82/city/Aachen" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/country/82/city/Aachen"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "city": {
            "id": 12850,
            "name": "Aachen"
        },
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        }
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/country/{country}/city/{pattern?}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>country</code></td>
<td>required</td>
<td>The country the city is in</td>
</tr>
<tr>
<td><code>pattern</code></td>
<td>optional</td>
<td>The name of the city</td>
</tr>
</tbody>
</table>
<!-- END_e35db8e545c70086574b63263307a7fa -->
<!-- START_6263ef6cb594649013166ca3335c39ca -->
<h2>Get all universities matching a pattern</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/university/name/Aachen" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/university/name/Aachen"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1388,
        "name": "Fachhochschule Aachen",
        "url": "http:\/\/www.fh-aachen.de\/"
    },
    {
        "id": 4044,
        "name": "Rheinisch Westfälische Technische Hochschule Aachen",
        "url": "http:\/\/www.rwth-aachen.de\/"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/university/name/{pattern?}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>pattern</code></td>
<td>optional</td>
<td>The pattern to match</td>
</tr>
</tbody>
</table>
<!-- END_6263ef6cb594649013166ca3335c39ca -->
<!-- START_7d3e0c818d37ab4c8daa837611173834 -->
<h2>Get all languages matching a pattern</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/language/name/Ger" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/language/name/Ger"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 23,
        "name": "German",
        "code": "de"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/language/name/{pattern?}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>pattern</code></td>
<td>optional</td>
<td>string The pattern to match</td>
</tr>
</tbody>
</table>
<!-- END_7d3e0c818d37ab4c8daa837611173834 -->
<!-- START_e35103caa1f21125175c80eb8a96cc65 -->
<h2>Get CHISV version info</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/version" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/version"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "branch": "dev",
    "commit": "7eb66fd398b7cf361fb688cddc5af60ed5820636",
    "tag": null
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/version</code></p>
<!-- END_e35103caa1f21125175c80eb8a96cc65 -->
<h1>Image</h1>
<!-- START_b10924faa610eedbd59487bb46359ef0 -->
<h2>Create a new image</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"image":"vitae","name":"Awesome image","type":"veniam","owner_id":1,"owner_type":"App\\User"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "image": "vitae",
    "name": "Awesome image",
    "type": "veniam",
    "owner_id": 1,
    "owner_type": "App\\User"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "The given data was invalid.",
    "errors": {
        "image": [
            "The image must be an image.",
            "The image must be a file of type: jpeg, png, jpg, gif.",
            "The image has invalid image dimensions."
        ],
        "type": [
            "The selected type is invalid."
        ]
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/image</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>image</code></td>
<td>binary-file</td>
<td>required</td>
<td>Binary image</td>
</tr>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>Image name</td>
</tr>
<tr>
<td><code>type</code></td>
<td>string</td>
<td>required</td>
<td>Can be one of 'artwork', 'icon' or 'avatar'</td>
</tr>
<tr>
<td><code>owner_id</code></td>
<td>integer</td>
<td>required</td>
<td>Reference the image to this model</td>
</tr>
<tr>
<td><code>owner_type</code></td>
<td>string</td>
<td>required</td>
<td>Reference the image to this model class</td>
</tr>
</tbody>
</table>
<!-- END_b10924faa610eedbd59487bb46359ef0 -->
<!-- START_a98e5b4669ac3fa3f0c1e821129382e7 -->
<h2>Update an image</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/image/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"image":"ea"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/image/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "image": "ea"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "The given data was invalid.",
    "errors": {
        "image": [
            "The image must be an image.",
            "The image must be a file of type: jpeg, png, jpg, gif.",
            "The image has invalid image dimensions."
        ]
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/image/{image}</code></p>
<p><code>PATCH api/v1/image/{image}</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>image</code></td>
<td>binary-file</td>
<td>required</td>
<td>Binary image</td>
</tr>
</tbody>
</table>
<!-- END_a98e5b4669ac3fa3f0c1e821129382e7 -->
<!-- START_bd133915229a369312c0c49c19e18d2c -->
<h2>Delete an image</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/image/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/image/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": null,
    "success": true,
    "message": "Image deleted!"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/image/{image}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>image</code></td>
<td>required</td>
<td>The image's id</td>
</tr>
</tbody>
</table>
<!-- END_bd133915229a369312c0c49c19e18d2c -->
<h1>Job</h1>
<!-- START_d6e16153e2ff68200766fc9789db9920 -->
<h2>Get all jobs</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/job" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/job"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [
        {
            "id": 3,
            "name": "Task import for dis19",
            "handler": "App\\Jobs\\ImportTasks",
            "result": "{\"create_success\":[null],\"create_fail\":[],\"update_success\":[],\"update_fail\":[],\"mismatch\":[],\"invalid\":[]}",
            "progress": 100,
            "status_message": null,
            "state_id": 23,
            "ended_at": "2020-07-06 18:40:14",
            "start_at": "2020-07-06 18:40:14",
            "created_at": "2020-07-06 18:40:14",
            "updated_at": "2020-07-06 18:40:14",
            "type": "job",
            "state": {
                "id": 23,
                "name": "successful",
                "for": "App\\Job",
                "description": "The job finished successfully"
            }
        },
        {
            "id": 2,
            "name": "Task import for dis19",
            "handler": "App\\Jobs\\ImportTasks",
            "result": "{\"create_success\":[],\"create_fail\":[],\"update_success\":[],\"update_fail\":[],\"mismatch\":[],\"invalid\":[]}",
            "progress": 100,
            "status_message": null,
            "state_id": 23,
            "ended_at": "2020-07-06 18:39:56",
            "start_at": "2020-07-06 18:39:56",
            "created_at": "2020-07-06 18:39:56",
            "updated_at": "2020-07-06 18:39:56",
            "type": "job",
            "state": {
                "id": 23,
                "name": "successful",
                "for": "App\\Job",
                "description": "The job finished successfully"
            }
        },
        {
            "id": 1,
            "name": "Task import for dis19",
            "handler": "App\\Jobs\\ImportTasks",
            "result": "{\"create_success\":[],\"create_fail\":[],\"update_success\":[],\"update_fail\":[],\"mismatch\":[],\"invalid\":[]}",
            "progress": 100,
            "status_message": null,
            "state_id": 23,
            "ended_at": "2020-07-06 18:39:44",
            "start_at": "2020-07-06 18:39:37",
            "created_at": "2020-07-06 18:39:37",
            "updated_at": "2020-07-06 18:39:44",
            "type": "job",
            "state": {
                "id": 23,
                "name": "successful",
                "for": "App\\Job",
                "description": "The job finished successfully"
            }
        }
    ],
    "total": 3,
    "take": 50
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/job</code></p>
<!-- END_d6e16153e2ff68200766fc9789db9920 -->
<!-- START_f0ecf6516bb0e1824e6db6d15f4731a1 -->
<h2>Get a job</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/job/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/job/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "name": "Task import for dis19",
    "handler": "App\\Jobs\\ImportTasks",
    "result": "{\"create_success\":[],\"create_fail\":[],\"update_success\":[],\"update_fail\":[],\"mismatch\":[],\"invalid\":[]}",
    "progress": 100,
    "status_message": null,
    "state_id": 23,
    "ended_at": "2020-07-06 18:39:44",
    "start_at": "2020-07-06 18:39:37",
    "created_at": "2020-07-06 18:39:37",
    "updated_at": "2020-07-06 18:39:44",
    "state": {
        "id": 23,
        "name": "successful",
        "for": "App\\Job",
        "description": "The job finished successfully"
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/job/{job}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>job</code></td>
<td>required</td>
<td>The job's id</td>
</tr>
</tbody>
</table>
<!-- END_f0ecf6516bb0e1824e6db6d15f4731a1 -->
<h1>Note</h1>
<!-- START_a6fe630930e6174d987c43d406b17684 -->
<h2>Create a new note</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/note" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"for_id":1,"for_type":"App\\User","text":"More than expected","conference_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/note"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "for_id": 1,
    "for_type": "App\\User",
    "text": "More than expected",
    "conference_id": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 2,
        "creator_id": 1,
        "for_id": 1,
        "for_type": "App\\User",
        "text": "More than expected",
        "created_at": "2020-07-06 20:52:32",
        "updated_at": "2020-07-06 20:52:32",
        "conference_id": "1"
    },
    "message": "Note created"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/note</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>for_id</code></td>
<td>integer</td>
<td>required</td>
<td>Id for the note's associated object</td>
</tr>
<tr>
<td><code>for_type</code></td>
<td>string</td>
<td>required</td>
<td>Class name for the note's associated object</td>
</tr>
<tr>
<td><code>text</code></td>
<td>string</td>
<td>required</td>
<td>The note's content</td>
</tr>
<tr>
<td><code>conference_id</code></td>
<td>integer</td>
<td>required</td>
<td>The conference to bind this note to (used for App\User)</td>
</tr>
</tbody>
</table>
<!-- END_a6fe630930e6174d987c43d406b17684 -->
<!-- START_e72a2bf06aae44bb29232368172c7ba6 -->
<h2>Delete a note</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/note/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/note/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Note deleted"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Note] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/note/{note}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>note</code></td>
<td>required</td>
<td>The note's id</td>
</tr>
</tbody>
</table>
<!-- END_e72a2bf06aae44bb29232368172c7ba6 -->
<h1>Notification</h1>
<!-- START_9810cba1aeb488235eda9984b2fca3e1 -->
<h2>Get all notification templates</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/notification_template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/notification_template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "chi19 Let's get registered",
        "conference_id": "1",
        "data": "{\"destinations\":[{\"role_id\":10,\"state_id\":12,\"type\":\"group\",\"display\":\"Accepted SVs\"}],\"elements\":[{\"type\":\"markdown\",\"data\":\"As you might have noticed, the CHI 20## registration site is live. Now we can step right into the next phase of the SV program! This email contains info about:\\n\\n- The SV contract\\n- Registration info (deadline: ###### ##nd, 20##)\\n- Visa support letters\\n- Slack Channel\\n- Housing\\n\\n\\n#THE SV CONTRACT\\n\\nPlease take the time to read this carefully. We want to make sure that everybody is on the same page when they arrive in Glasgow and knows what is expected of them. Being an SV at CHI can be a wonderful experience, but it's less wonderful when you are working extra hours, because a fellow SV didn't step up and work their hours.\\n\\n##You agree to\\n\\n1. Volunteer a _minimum_ of __20 hours__ at the conference as a student volunteer.\\n\\n2. Arrive in Glasgow on or before Sunday, __May 5th__, and stay through the end of the conference on Thursday, May 9th (or Friday, May 10th, if you plan to attend the SV Party).\\n\\n3. Attend one of the three SV orientations. The orientation times are __Saturday, May 4th at 6pm__ and __Sunday, May 5th at 11am and 6pm__.\\n\\n##We agree to\\n\\n1. Waive your registration fees and give you a conference reception ticket (you must pay workshop\\\\\\\\\/course fees, if you want to attend any).\\n\\n2. Provide you with breakfast and lunch daily (food details are still being worked out).\\n\\n\\n#LET'S GET REGISTERED\\n\\nRegistration is now open! Here's the process for registering for CHI 2019 as a student volunteer. (Note: you must register for the conference by February 22nd, 2019 to maintain your SV spot. If you know that you can't attend, please let us know as soon as possible so we can give your spot to someone on the waitlist).\\n\\n1. Go to [this website](http:\/\/www.cvent.com).\\n__ATTENTION: This link can ONLY be used by accepted Student Volunteers.__\\n\\n\\n##Important additional details\\nIf we haven't heard from you in any way by February 22nd, 2018, 12:00 EST, we will assume you are no longer interested in volunteering, and will remove you from the SV accepted list.\\n\\nPlease let us know if you have any issues, we are happy to work things out with you!\\n\\n\\n#VISA SUPPORT LETTERS\\n\\nYou need to download the request form as part of the registration process and follow the instructions described in that form.\\n\\n\\n#SLACK CHANNEL\\n\\nWe will invite you to our Slack Channel as soon as you are registered for the conference. Slack is a good place for you to introduce yourselves to your fellow SVs, or to coordinate sharing a hotel room. It also provides us with a much faster channel to reach you (and vice versa) during the conference, so please accept the invitation as soon as you receive it.\\n\\n\\n## HOUSING\\nYou can find information about housing at [chi2019.acm.org\/for-attendees\/hotels](https:\/\/chi2019.acm.org\/for-attendees\/hotels\/) - the estimated rates are included below. To reduce your accommodation costs, you can share rooms with fellow SVs. You can talk to your fellow SVs via Slack and find someone to share a room with. Use the #housing channel. However, there are a couple of things that you should keep in mind before booking a hotel room together:\\n\\n##CONFERENCE HOTEL RATES\\nHere are the conference hotel rates for your reference. They are also available on the conference website. Most of these are for a single or double room.\\n\\n\\nThat's it for now - if you have any other questions: just email us and we will do our best to help you with any questions as quickly as we can.\"}],\"greeting\":null,\"subject\":\"LET'S GET REGISTERED -- DEADLINES INSIDE\",\"salutation\":\"Regards,\\n\\nSV Chairs CHI20, Honolulu, Hawai\\u02bbi, USA\\n\\n[noreply@chisv.org](mailto:noreply@chisv.org)\\n\\n[ACM](https:\/\/www.acm.org\/)\"}",
        "year": "2020",
        "created_at": null,
        "updated_at": null,
        "conference": {
            "id": 1,
            "key": "chi20"
        }
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/notification_template</code></p>
<!-- END_9810cba1aeb488235eda9984b2fca3e1 -->
<!-- START_3437a4c594338a2408235c8bd5cea113 -->
<h2>Create a new notification template</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/notification_template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"name":"My New Template!","data":{"destinations":[{"type":"group","role_id":10,"state_id":12}],"elements":[{"type":"action","data":{"caption":"CHISV Website","url":"https:\/\/chisv.org"}},{"type":"markdown","data":"!See text below"}]},"year":2020,"conference_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/notification_template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "name": "My New Template!",
    "data": {
        "destinations": [
            {
                "type": "group",
                "role_id": 10,
                "state_id": 12
            }
        ],
        "elements": [
            {
                "type": "action",
                "data": {
                    "caption": "CHISV Website",
                    "url": "https:\/\/chisv.org"
                }
            },
            {
                "type": "markdown",
                "data": "!See text below"
            }
        ]
    },
    "year": 2020,
    "conference_id": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Template created"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/notification_template</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>Give the template a unique name</td>
</tr>
<tr>
<td><code>data</code></td>
<td>string</td>
<td>required</td>
<td>The enrollment form template in JSON encoded form</td>
</tr>
<tr>
<td><code>year</code></td>
<td>integer</td>
<td>required</td>
<td>YYYY formatted year</td>
</tr>
<tr>
<td><code>conference_id</code></td>
<td>integer</td>
<td>required</td>
<td>Bind to this conference</td>
</tr>
<tr>
<td><code>data.destinations</code></td>
<td>array</td>
<td>required</td>
<td>Multiple destinations, see below for 3 examples</td>
</tr>
<tr>
<td><code>data.destinations[0].type</code></td>
<td>string</td>
<td>optional</td>
<td>Must be 'group'</td>
</tr>
<tr>
<td><code>data.destinations[0].role_id</code></td>
<td>integer</td>
<td>optional</td>
<td>Pointing to the role by id</td>
</tr>
<tr>
<td><code>data.destinations[0].state_id</code></td>
<td>integer</td>
<td>optional</td>
<td>Pointing to the state by id</td>
</tr>
<tr>
<td><code>data.elements</code></td>
<td>array</td>
<td>required</td>
<td>Multiple elements, see below for action and markdown below</td>
</tr>
<tr>
<td><code>data.elements[0].type</code></td>
<td>required</td>
<td>optional</td>
<td>One of 'action', 'markdown'</td>
</tr>
<tr>
<td><code>data.elements[1].type</code></td>
<td>required</td>
<td>optional</td>
<td>One of 'action', 'markdown'</td>
</tr>
<tr>
<td><code>data.elements[0].data.caption</code></td>
<td>string</td>
<td>optional</td>
<td>Is required if type is 'action'</td>
</tr>
<tr>
<td><code>data.elements[0].data.url</code></td>
<td>string</td>
<td>optional</td>
<td>Is required if type is 'action'</td>
</tr>
<tr>
<td><code>data.elements[1].data</code></td>
<td>string</td>
<td>optional</td>
<td>Is required if type is 'markdown'</td>
</tr>
</tbody>
</table>
<!-- END_3437a4c594338a2408235c8bd5cea113 -->
<!-- START_9a71c195bef487ee5f5fcae091218d61 -->
<h2>Delete a notification template</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/notification_template/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/notification_template/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Template deleted"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/notification_template/{notification_template}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>notification_template</code></td>
<td>required</td>
<td>The notification template's id to delete</td>
</tr>
</tbody>
</table>
<!-- END_9a71c195bef487ee5f5fcae091218d61 -->
<!-- START_dab1dd2c6a2e20ca5a7543c7bb923357 -->
<h2>Get all notifications of the authenticated user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [
        {
            "id": "f8f02574-a9eb-408b-9836-c7408b248afb",
            "type": "App\\Notifications\\Announcement",
            "read_at": null,
            "created_at": "2020-07-06T18:11:53.000000Z",
            "subject": "SV Announcement",
            "conference_key": "chi20"
        },
        {
            "id": "05f4e434-6efb-4559-9081-d67ecdd0bc8b",
            "type": "App\\Notifications\\Announcement",
            "read_at": null,
            "created_at": "2020-07-06T18:11:53.000000Z",
            "subject": "SV Announcement",
            "conference_key": "chi20"
        }
    ],
    "clearUntil": "2020-07-06 20:52:32"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/notification</code></p>
<!-- END_dab1dd2c6a2e20ca5a7543c7bb923357 -->
<!-- START_aae6a7590ad399556c68f3f43d3b8180 -->
<h2>Get a notification</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/notification/f8f02574-a9eb-408b-9836-c7408b248afb" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/notification/f8f02574-a9eb-408b-9836-c7408b248afb"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">null</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [Illuminate\\Notifications\\DatabaseNotification] fd8f02574-a9eb-408b-9836-c7408b248afb"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/notification/{database_notification}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>database_notification</code></td>
<td>required</td>
<td>Notification's UUID</td>
</tr>
</tbody>
</table>
<!-- END_aae6a7590ad399556c68f3f43d3b8180 -->
<h1>Permission</h1>
<!-- START_7ae99daa4c685955a0bb1957dc7c7125 -->
<h2>Create a new permission</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/permission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"user_id":1,"role_id":2,"conference_id":1,"state_id":11}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/permission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "user_id": 1,
    "role_id": 2,
    "conference_id": 1,
    "state_id": 11
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Permission granted!"
}</code></pre>
<blockquote>
<p>Example response (400):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Permission already exists"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/permission</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's id</td>
</tr>
<tr>
<td><code>role_id</code></td>
<td>integer</td>
<td>required</td>
<td>The role of the permission by id</td>
</tr>
<tr>
<td><code>conference_id</code></td>
<td>integer</td>
<td>optional</td>
<td>The conference id to bind the permission to</td>
</tr>
<tr>
<td><code>state_id</code></td>
<td>integer</td>
<td>optional</td>
<td>The permission's state</td>
</tr>
</tbody>
</table>
<!-- END_7ae99daa4c685955a0bb1957dc7c7125 -->
<!-- START_02593a89d7299e12fbe17b2a19fbeac2 -->
<h2>Update a permission</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/permission/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"user_id":1,"role_id":2,"conference_id":1,"state_id":11}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/permission/2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "user_id": 1,
    "role_id": 2,
    "conference_id": 1,
    "state_id": 11
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 2,
        "user_id": 2,
        "conference_id": 1,
        "created_at": "2020-07-04 14:12:31",
        "updated_at": "2020-07-06 20:52:32",
        "enrollment_form_id": 3,
        "lottery_position": null,
        "conference": {
            "id": 1,
            "name": "CHI 2020",
            "key": "chi20",
            "location": "Honolulu, Hawaiʻi, USA",
            "timezone_id": 366,
            "start_date": "2020-07-01",
            "end_date": "2020-07-07",
            "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
            "enrollment_form_id": 1,
            "state_id": 4,
            "url": "https:\/\/www.acm.org\/",
            "url_name": "ACM",
            "created_at": "2020-07-04 14:12:29",
            "updated_at": "2020-07-06 20:38:18",
            "volunteer_hours": 20,
            "volunteer_max": 100,
            "email_chair": "noreply@chisv.org",
            "bidding_start": "2020-07-01",
            "bidding_end": "2020-07-23",
            "bidding_enabled": true
        }
    },
    "message": "Permission updated!"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/permission/{permission}</code></p>
<p><code>PATCH api/v1/permission/{permission}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>permission</code></td>
<td>required</td>
<td>The permission's id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's id</td>
</tr>
<tr>
<td><code>role_id</code></td>
<td>integer</td>
<td>required</td>
<td>The role of the permission by id</td>
</tr>
<tr>
<td><code>conference_id</code></td>
<td>integer</td>
<td>optional</td>
<td>The conference id to bind the permission to</td>
</tr>
<tr>
<td><code>state_id</code></td>
<td>integer</td>
<td>optional</td>
<td>The permission's state</td>
</tr>
</tbody>
</table>
<!-- END_02593a89d7299e12fbe17b2a19fbeac2 -->
<!-- START_44ad155ad0de0418e9d1794951e82dfc -->
<h2>Delete a new permission</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/permission/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/permission/2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "success": true,
    "message": "Permission revoked"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Permission] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/permission/{permission}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>permission</code></td>
<td>required</td>
<td>The permission's id</td>
</tr>
</tbody>
</table>
<!-- END_44ad155ad0de0418e9d1794951e82dfc -->
<h1>Report</h1>
<!-- START_e367f5d326b0f2aa81935f2faf023e9d -->
<h2>Get a report by name</h2>
<p>The result will contain all important columns and pagination hint. Available reports are:
&#039;sv_doubles&#039;,
&#039;sv_accepted_minutes_ago&#039;,
&#039;sv_shirts&#039;,
&#039;sv_hours&#039;,
&#039;sv_bids&#039;,
&#039;sv_detail&#039;,
&#039;sv_demographics_country&#039;,
&#039;sv_demographics_language&#039;,
&#039;task_overview&#039;,
&#039;tasks_free_slots&#039;,
&#039;tasks_table_dump&#039;</p>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/report/sv_hours" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/report/sv_hours"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "columns": [
        {
            "field": "firstname",
            "label": "Firstname",
            "width": null,
            "numeric": false,
            "sortable": true,
            "searchable": true
        },
        {
            "field": "lastname",
            "label": "Lastname",
            "width": null,
            "numeric": false,
            "sortable": true,
            "searchable": true
        },
        {
            "field": "hours_done",
            "label": "Hours Done",
            "width": null,
            "numeric": true,
            "sortable": true,
            "searchable": false
        },
        {
            "field": "assignments_count",
            "label": "Assignments",
            "width": null,
            "numeric": true,
            "sortable": true,
            "searchable": false
        }
    ],
    "data": [
        {
            "user_id": 2,
            "firstname": "Alessandro",
            "lastname": "Sanford",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 3,
            "firstname": "River",
            "lastname": "Leannon",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 4,
            "firstname": "Mara",
            "lastname": "Bergstrom",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 7,
            "firstname": "Tom",
            "lastname": "Mante",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 8,
            "firstname": "Tito",
            "lastname": "Kuphal",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 9,
            "firstname": "Jade",
            "lastname": "Jerde",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 11,
            "firstname": "Meagan",
            "lastname": "Runolfsdottir",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 1,
            "firstname": "ADMIN Milton",
            "lastname": "Waddams",
            "hours_done": 0,
            "assignments_count": 1
        }
    ],
    "updated": "2020-07-06T20:52:29.653315Z",
    "paginate": true
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/report/{name}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
<tr>
<td><code>name</code></td>
<td>required</td>
<td>The reports key</td>
</tr>
</tbody>
</table>
<!-- END_e367f5d326b0f2aa81935f2faf023e9d -->
<h1>Role</h1>
<!-- START_e7e28d5abb6f2e2aebbd819249e3df74 -->
<h2>Get all roles</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/role" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/role"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "admin",
        "description": "Can do anything"
    },
    {
        "id": 2,
        "name": "chair",
        "description": "Can manage conference details, tasks and assignments"
    },
    {
        "id": 3,
        "name": "captain",
        "description": "Can manage tasks and assignments"
    },
    {
        "id": 10,
        "name": "sv",
        "description": "Is associated for conferences as SV"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/role</code></p>
<!-- END_e7e28d5abb6f2e2aebbd819249e3df74 -->
<h1>State</h1>
<!-- START_0732eddb955a8a3d8ab42725aabda922 -->
<h2>Get all states</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/state" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/state"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "name": "planning",
        "for": "App\\Conference",
        "description": "The conference is invisible to students (only open for administrative purposes)"
    },
    {
        "id": 2,
        "name": "enrollment",
        "for": "App\\Conference",
        "description": "Students can enroll in the conference"
    },
    {
        "id": 3,
        "name": "registration",
        "for": "App\\Conference",
        "description": "The lottery was run and we are waiting for student registrations"
    },
    {
        "id": 4,
        "name": "running",
        "for": "App\\Conference",
        "description": "The conference is running"
    },
    {
        "id": 5,
        "name": "over",
        "for": "App\\Conference",
        "description": "The conference is over"
    },
    {
        "id": 11,
        "name": "enrolled",
        "for": "App\\User",
        "description": "Waiting to be accepted, waitlisted or dropped"
    },
    {
        "id": 12,
        "name": "accepted",
        "for": "App\\User",
        "description": "Accepted to the conference as SV"
    },
    {
        "id": 13,
        "name": "waitlisted",
        "for": "App\\User",
        "description": "Waiting to be accepted when other SVs cancel"
    },
    {
        "id": 14,
        "name": "dropped",
        "for": "App\\User",
        "description": "Dropped from the conference"
    },
    {
        "id": 21,
        "name": "planned",
        "for": "App\\Job",
        "description": "The job is planned to be run in the future"
    },
    {
        "id": 22,
        "name": "processing",
        "for": "App\\Job",
        "description": "The job is currently running"
    },
    {
        "id": 23,
        "name": "successful",
        "for": "App\\Job",
        "description": "The job finished successfully"
    },
    {
        "id": 24,
        "name": "failed",
        "for": "App\\Job",
        "description": "The job stopped and failed"
    },
    {
        "id": 25,
        "name": "softfail",
        "for": "App\\Job",
        "description": "The job encountered an error and will restart shortly"
    },
    {
        "id": 31,
        "name": "placed",
        "for": "App\\Bid",
        "description": "The bid is waiting for the auction"
    },
    {
        "id": 32,
        "name": "successful",
        "for": "App\\Bid",
        "description": "The bid won the auction creating an assignment"
    },
    {
        "id": 33,
        "name": "unsuccessful",
        "for": "App\\Bid",
        "description": "The bid did not win the auction (all slots filled)"
    },
    {
        "id": 34,
        "name": "conflict",
        "for": "App\\Bid",
        "description": "The bid is invalid due to a task time conflict"
    },
    {
        "id": 35,
        "name": "unavailable",
        "for": "App\\Bid",
        "description": "The bid expresses unavailability, thus blocked assignment"
    },
    {
        "id": 41,
        "name": "assigned",
        "for": "App\\Assignment",
        "description": "The task is assigned but yet not being worked on"
    },
    {
        "id": 42,
        "name": "checked-in",
        "for": "App\\Assignment",
        "description": "SV is working on the task at the moment"
    },
    {
        "id": 43,
        "name": "done",
        "for": "App\\Assignment",
        "description": "Task has been completed"
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/state</code></p>
<!-- END_0732eddb955a8a3d8ab42725aabda922 -->
<h1>Task</h1>
<!-- START_e56949261df93656a185127400a20c95 -->
<h2>Create a new task</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/task" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"conference_id":1,"name":"SVing Task","location":"Main Hall","description":"Nothing to do here","date":"2020-07-01","start_at":"12:00:00","end_at":"15:00:00","hours":3,"priority":2,"slots":5}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/task"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "conference_id": 1,
    "name": "SVing Task",
    "location": "Main Hall",
    "description": "Nothing to do here",
    "date": "2020-07-01",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "hours": 3,
    "priority": 2,
    "slots": 5
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 504,
    "conference_id": "1",
    "name": "SVing Task",
    "description": "Nothing to do here",
    "location": "Main Hall",
    "date": "2020-07-01 00:00:00",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "priority": 2,
    "slots": 5,
    "hours": 3
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/task</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference_id</code></td>
<td>integer</td>
<td>required</td>
<td>Create task for this conference by id</td>
</tr>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>Task's name</td>
</tr>
<tr>
<td><code>location</code></td>
<td>string</td>
<td>required</td>
<td>Task's location</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>required</td>
<td>Task's description</td>
</tr>
<tr>
<td><code>date</code></td>
<td>string</td>
<td>required</td>
<td>Task's date</td>
</tr>
<tr>
<td><code>start_at</code></td>
<td>string</td>
<td>required</td>
<td>Task's start time</td>
</tr>
<tr>
<td><code>end_at</code></td>
<td>string</td>
<td>required</td>
<td>Task's end time</td>
</tr>
<tr>
<td><code>hours</code></td>
<td>integer</td>
<td>required</td>
<td>Task's accounted hours</td>
</tr>
<tr>
<td><code>priority</code></td>
<td>integer</td>
<td>required</td>
<td>Task's priority</td>
</tr>
<tr>
<td><code>slots</code></td>
<td>integer</td>
<td>required</td>
<td>Max allowed SVs</td>
</tr>
</tbody>
</table>
<!-- END_e56949261df93656a185127400a20c95 -->
<!-- START_8c6e980f4862789e22b0446062343f9c -->
<h2>Update a task</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/task/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"conference_id":1,"name":"SVing Task","location":"Main Hall","description":"Nothing to do here","date":"2020-07-01","start_at":"12:00:00","end_at":"15:00:00","hours":3,"priority":2,"slots":5}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/task/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "conference_id": 1,
    "name": "SVing Task",
    "location": "Main Hall",
    "description": "Nothing to do here",
    "date": "2020-07-01",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "hours": 3,
    "priority": 2,
    "slots": 5
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "conference_id": "2",
    "name": "SVing Task",
    "description": "Nothing to do here",
    "location": "Main Hall",
    "date": "2020-07-01 00:00:00",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "priority": 2,
    "slots": 5,
    "hours": 3
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/task/{task}</code></p>
<p><code>PATCH api/v1/task/{task}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>task</code></td>
<td>required</td>
<td>Task's id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>conference_id</code></td>
<td>integer</td>
<td>required</td>
<td>Bound to this conference by id</td>
</tr>
<tr>
<td><code>name</code></td>
<td>string</td>
<td>required</td>
<td>Task's name</td>
</tr>
<tr>
<td><code>location</code></td>
<td>string</td>
<td>required</td>
<td>Task's location</td>
</tr>
<tr>
<td><code>description</code></td>
<td>string</td>
<td>required</td>
<td>Task's description</td>
</tr>
<tr>
<td><code>date</code></td>
<td>string</td>
<td>required</td>
<td>Task's date</td>
</tr>
<tr>
<td><code>start_at</code></td>
<td>string</td>
<td>required</td>
<td>Task's start time</td>
</tr>
<tr>
<td><code>end_at</code></td>
<td>string</td>
<td>required</td>
<td>Task's end time</td>
</tr>
<tr>
<td><code>hours</code></td>
<td>integer</td>
<td>required</td>
<td>Task's accounted hours</td>
</tr>
<tr>
<td><code>priority</code></td>
<td>integer</td>
<td>required</td>
<td>Task's priority</td>
</tr>
<tr>
<td><code>slots</code></td>
<td>integer</td>
<td>required</td>
<td>Max allowed SVs</td>
</tr>
</tbody>
</table>
<!-- END_8c6e980f4862789e22b0446062343f9c -->
<!-- START_3e2ac028a2ca35997032bf708b18c0c2 -->
<h2>Delete a task</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/task/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/task/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Task removed. 0\/0\/0 associated bids\/assignments\/notes have been deleted."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/task/{task}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>task</code></td>
<td>required</td>
<td>Task's id</td>
</tr>
</tbody>
</table>
<!-- END_3e2ac028a2ca35997032bf708b18c0c2 -->
<h1>User</h1>
<!-- START_8ae5d428da27b2b014dc767c2f19a813 -->
<h2>Create a new user</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"firstname":"Jacob","lastname":"Smith","email":"jacob@example.com","languages":[{"id":23}],"location":{"country":{"id":82,"name":"Germany"},"region":{"id":1268,"name":"Nordrhein-Westfalen"},"city":{"id":12850,"name":"Aachen"}},"university":{"id":4044,"name":"RWTH Aachen"},"degree_id":2,"shirt_id":3,"locale_id":51,"past_conferences":["CHI 2019"],"past_conferences_sv":["CHI 2019"],"password":"secret","password_confirmation":"secret"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "firstname": "Jacob",
    "lastname": "Smith",
    "email": "jacob@example.com",
    "languages": [
        {
            "id": 23
        }
    ],
    "location": {
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        }
    },
    "university": {
        "id": 4044,
        "name": "RWTH Aachen"
    },
    "degree_id": 2,
    "shirt_id": 3,
    "locale_id": 51,
    "past_conferences": [
        "CHI 2019"
    ],
    "past_conferences_sv": [
        "CHI 2019"
    ],
    "password": "secret",
    "password_confirmation": "secret"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "firstname": "Jacob",
        "lastname": "Smith",
        "email": "jacob@example.com",
        "locale_id": 51,
        "degree_id": 2,
        "shirt_id": 3,
        "past_conferences": [
            "CHI 2019"
        ],
        "past_conferences_sv": [
            "CHI 2019"
        ],
        "country_id": 82,
        "region_id": 1268,
        "city_id": 12850,
        "university_id": 4044,
        "updated_at": "2020-07-06 20:52:29",
        "created_at": "2020-07-06 20:52:29",
        "id": 12
    },
    "error": null
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/register</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>firstname</code></td>
<td>string</td>
<td>required</td>
<td>The user's first name</td>
</tr>
<tr>
<td><code>lastname</code></td>
<td>string</td>
<td>required</td>
<td>The user's last name</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>The user's email</td>
</tr>
<tr>
<td><code>languages</code></td>
<td>array&lt;<a href="#get-all-languages-matching-a-pattern">Language</a>&gt;</td>
<td>optional</td>
<td>An array of languages</td>
</tr>
<tr>
<td><code>languages.*.id</code></td>
<td>integer</td>
<td>required</td>
<td>A <a href="#get-all-languages-matching-a-pattern">language's</a> id</td>
</tr>
<tr>
<td><code>location</code></td>
<td><a href="#get-all-locations-for-a-country-by-city-name">Location</a></td>
<td>required</td>
<td>The users location by city name</td>
</tr>
<tr>
<td><code>location.country.id</code></td>
<td>integer</td>
<td>required</td>
<td>The location's country id</td>
</tr>
<tr>
<td><code>location.country.name</code></td>
<td>string</td>
<td>optional</td>
<td>The location's country name</td>
</tr>
<tr>
<td><code>location.region.id</code></td>
<td>integer</td>
<td>optional</td>
<td>The location's region id</td>
</tr>
<tr>
<td><code>location.region.name</code></td>
<td>string</td>
<td>optional</td>
<td>The location's region name</td>
</tr>
<tr>
<td><code>location.city.id</code></td>
<td>integer</td>
<td>optional</td>
<td>The location's city id</td>
</tr>
<tr>
<td><code>location.city.name</code></td>
<td>string</td>
<td>optional</td>
<td>The location's city name</td>
</tr>
<tr>
<td><code>university.id</code></td>
<td>integer</td>
<td>optional</td>
<td>The <a href="#get-all-universities-matching-a-pattern">university's</a> id</td>
</tr>
<tr>
<td><code>university.name</code></td>
<td>string</td>
<td>optional</td>
<td>The fallback university's name if no id used (see above)</td>
</tr>
<tr>
<td><code>degree_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's <a href="#get-all-degrees">degree</a></td>
</tr>
<tr>
<td><code>shirt_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's <a href="#get-all-t-shirts">shirt</a></td>
</tr>
<tr>
<td><code>locale_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's <a href="#get-all-locales">locale</a></td>
</tr>
<tr>
<td><code>past_conferences</code></td>
<td>array&lt;string&gt;</td>
<td>optional</td>
<td>The user's past attended conferences as array</td>
</tr>
<tr>
<td><code>past_conferences.*</code></td>
<td>string</td>
<td>optional</td>
<td>A user's past attended conference</td>
</tr>
<tr>
<td><code>past_conferences_sv</code></td>
<td>array&lt;string&gt;</td>
<td>optional</td>
<td>The user's past attended conferences as SV as array</td>
</tr>
<tr>
<td><code>past_conferences_sv.*</code></td>
<td>string</td>
<td>optional</td>
<td>A user's past attended conference as SV</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>optional</td>
<td>The user's password</td>
</tr>
<tr>
<td><code>password_confirmation</code></td>
<td>string</td>
<td>optional</td>
<td>The user's password</td>
</tr>
</tbody>
</table>
<!-- END_8ae5d428da27b2b014dc767c2f19a813 -->
<!-- START_3b01a55d7c160fc3bce9f7104ed40bc5 -->
<h2>Get the authenticated user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/user/self" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/user/self"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "firstname": "ADMIN Milton",
    "lastname": "Waddams",
    "past_conferences": null,
    "past_conferences_sv": null,
    "permissions": [
        {
            "id": 14,
            "role": {
                "id": 10,
                "name": "sv",
                "description": "Is associated for conferences as SV"
            },
            "state": {
                "id": 12,
                "name": "accepted",
                "description": "Accepted to the conference as SV"
            },
            "enrollment_form": {
                "id": 14,
                "name": "Default",
                "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":false,\"weight\":0,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":0,\"weight\":0,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":2,\"weight\":0,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":true,\"weight\":0,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"sd\",\"required\":true}}}"
            },
            "conference": {
                "id": 1,
                "key": "chi20"
            }
        },
        {
            "id": 12,
            "role": {
                "id": 1,
                "name": "admin",
                "description": "Can do anything"
            },
            "state": null,
            "enrollment_form": null,
            "conference": null
        }
    ],
    "locale": {
        "id": 40,
        "code": "en",
        "name": "English (United States)"
    },
    "avatar": null
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/user/self</code></p>
<!-- END_3b01a55d7c160fc3bce9f7104ed40bc5 -->
<!-- START_621dcdc4770a45b8129b12966db31c4d -->
<h2>Get all bids for a user of a given conference</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/user/1/bid/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/user/1/bid/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">[
    {
        "id": 1,
        "task_id": 8,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 8,
            "name": "Offset Lithographic Press Operator",
            "start_at": "13:45:00",
            "end_at": "14:15:00",
            "hours": 0.5,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 2,
        "task_id": 12,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 12,
            "name": "Stock Broker",
            "start_at": "08:45:00",
            "end_at": "10:30:00",
            "hours": 1.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 3,
        "task_id": 18,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 18,
            "name": "Director Of Talent Acquisition",
            "start_at": "17:45:00",
            "end_at": "18:30:00",
            "hours": 0.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 4,
        "task_id": 33,
        "state_id": 31,
        "preference": 0,
        "task": {
            "id": 33,
            "name": "Grinding Machine Operator",
            "start_at": "10:00:00",
            "end_at": "11:45:00",
            "hours": 1.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 5,
        "task_id": 35,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 35,
            "name": "Central Office and PBX Installers",
            "start_at": "10:00:00",
            "end_at": "11:00:00",
            "hours": 1,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 6,
        "task_id": 49,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 49,
            "name": "Logging Tractor Operator",
            "start_at": "16:15:00",
            "end_at": "18:30:00",
            "hours": 2.25,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 7,
        "task_id": 56,
        "state_id": 31,
        "preference": 0,
        "task": {
            "id": 56,
            "name": "Paving Equipment Operator",
            "start_at": "15:30:00",
            "end_at": "17:15:00",
            "hours": 1.75,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 8,
        "task_id": 57,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 57,
            "name": "Media and Communication Worker",
            "start_at": "13:30:00",
            "end_at": "15:15:00",
            "hours": 1.75,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 9,
        "task_id": 61,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 61,
            "name": "Atmospheric and Space Scientist",
            "start_at": "11:15:00",
            "end_at": "12:30:00",
            "hours": 1.25,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 10,
        "task_id": 62,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 62,
            "name": "Oil and gas Operator",
            "start_at": "16:45:00",
            "end_at": "17:45:00",
            "hours": 1,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 11,
        "task_id": 64,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 64,
            "name": "Sawing Machine Operator",
            "start_at": "17:30:00",
            "end_at": "17:45:00",
            "hours": 0.25,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 12,
        "task_id": 66,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 66,
            "name": "Health Technologist",
            "start_at": "16:30:00",
            "end_at": "18:30:00",
            "hours": 2,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 13,
        "task_id": 74,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 74,
            "name": "Umpire and Referee",
            "start_at": "16:45:00",
            "end_at": "18:15:00",
            "hours": 1.5,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 14,
        "task_id": 84,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 84,
            "name": "Postal Service Mail Sorter",
            "start_at": "12:45:00",
            "end_at": "14:30:00",
            "hours": 1.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 15,
        "task_id": 85,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 85,
            "name": "Radiation Therapist",
            "start_at": "09:45:00",
            "end_at": "11:15:00",
            "hours": 1.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 16,
        "task_id": 92,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 92,
            "name": "Tank Car",
            "start_at": "15:45:00",
            "end_at": "16:15:00",
            "hours": 0.5,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 17,
        "task_id": 116,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 116,
            "name": "Sewing Machine Operator",
            "start_at": "14:00:00",
            "end_at": "15:30:00",
            "hours": 1.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 18,
        "task_id": 123,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 123,
            "name": "Offset Lithographic Press Operator",
            "start_at": "11:45:00",
            "end_at": "12:30:00",
            "hours": 0.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 19,
        "task_id": 129,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 129,
            "name": "Umpire and Referee",
            "start_at": "17:45:00",
            "end_at": "18:30:00",
            "hours": 0.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 20,
        "task_id": 137,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 137,
            "name": "Sketch Artist",
            "start_at": "08:00:00",
            "end_at": "09:00:00",
            "hours": 1,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 21,
        "task_id": 146,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 146,
            "name": "House Cleaner",
            "start_at": "10:30:00",
            "end_at": "11:15:00",
            "hours": 0.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 22,
        "task_id": 147,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 147,
            "name": "Food Preparation",
            "start_at": "16:45:00",
            "end_at": "17:15:00",
            "hours": 0.5,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 23,
        "task_id": 151,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 151,
            "name": "Paste-Up Worker",
            "start_at": "13:15:00",
            "end_at": "13:30:00",
            "hours": 0.25,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 24,
        "task_id": 155,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 155,
            "name": "Production Worker",
            "start_at": "10:15:00",
            "end_at": "10:45:00",
            "hours": 0.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 25,
        "task_id": 158,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 158,
            "name": "Rough Carpenter",
            "start_at": "14:30:00",
            "end_at": "15:45:00",
            "hours": 1.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 26,
        "task_id": 167,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 167,
            "name": "Bellhop",
            "start_at": "17:45:00",
            "end_at": "18:15:00",
            "hours": 0.5,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 27,
        "task_id": 168,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 168,
            "name": "Retail Sales person",
            "start_at": "08:00:00",
            "end_at": "09:00:00",
            "hours": 1,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 28,
        "task_id": 174,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 174,
            "name": "Municipal Fire Fighting Supervisor",
            "start_at": "14:45:00",
            "end_at": "15:15:00",
            "hours": 0.5,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 29,
        "task_id": 182,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 182,
            "name": "Police Identification OR Records Officer",
            "start_at": "09:00:00",
            "end_at": "10:15:00",
            "hours": 1.25,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 30,
        "task_id": 185,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 185,
            "name": "Social Worker",
            "start_at": "16:00:00",
            "end_at": "18:00:00",
            "hours": 2,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 31,
        "task_id": 187,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 187,
            "name": "Cement Mason and Concrete Finisher",
            "start_at": "10:30:00",
            "end_at": "12:15:00",
            "hours": 1.75,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 32,
        "task_id": 214,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 214,
            "name": "Manager of Food Preparation",
            "start_at": "08:00:00",
            "end_at": "10:00:00",
            "hours": 2,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 33,
        "task_id": 236,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 236,
            "name": "Copy Machine Operator",
            "start_at": "13:00:00",
            "end_at": "15:00:00",
            "hours": 2,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 34,
        "task_id": 247,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 247,
            "name": "Special Forces Officer",
            "start_at": "08:00:00",
            "end_at": "08:30:00",
            "hours": 0.5,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 35,
        "task_id": 278,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 278,
            "name": "Healthcare Practitioner",
            "start_at": "17:00:00",
            "end_at": "18:15:00",
            "hours": 1.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 36,
        "task_id": 284,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 284,
            "name": "Photoengraver",
            "start_at": "15:15:00",
            "end_at": "15:45:00",
            "hours": 0.5,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 37,
        "task_id": 288,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 288,
            "name": "Business Manager",
            "start_at": "14:30:00",
            "end_at": "16:15:00",
            "hours": 1.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 38,
        "task_id": 290,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 290,
            "name": "Transit Police OR Railroad Police",
            "start_at": "10:00:00",
            "end_at": "11:00:00",
            "hours": 1,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 39,
        "task_id": 312,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 312,
            "name": "Library Worker",
            "start_at": "08:45:00",
            "end_at": "09:45:00",
            "hours": 1,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 40,
        "task_id": 313,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 313,
            "name": "Lawyer",
            "start_at": "16:15:00",
            "end_at": "17:45:00",
            "hours": 1.5,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 41,
        "task_id": 315,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 315,
            "name": "University",
            "start_at": "08:00:00",
            "end_at": "09:15:00",
            "hours": 1.25,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 42,
        "task_id": 316,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 316,
            "name": "Secondary School Teacher",
            "start_at": "13:00:00",
            "end_at": "14:00:00",
            "hours": 1,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 43,
        "task_id": 321,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 321,
            "name": "Photographic Restorer",
            "start_at": "17:15:00",
            "end_at": "17:45:00",
            "hours": 0.5,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 44,
        "task_id": 351,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 351,
            "name": "Counselor",
            "start_at": "08:00:00",
            "end_at": "08:45:00",
            "hours": 0.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 45,
        "task_id": 360,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 360,
            "name": "Heavy Equipment Mechanic",
            "start_at": "15:45:00",
            "end_at": "16:30:00",
            "hours": 0.75,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 46,
        "task_id": 362,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 362,
            "name": "Military Officer",
            "start_at": "09:00:00",
            "end_at": "11:00:00",
            "hours": 2,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 47,
        "task_id": 365,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 365,
            "name": "Fashion Designer",
            "start_at": "08:00:00",
            "end_at": "09:30:00",
            "hours": 1.5,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 48,
        "task_id": 373,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 373,
            "name": "Plate Finisher",
            "start_at": "12:15:00",
            "end_at": "13:30:00",
            "hours": 1.25,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 49,
        "task_id": 381,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 381,
            "name": "Electronics Engineering Technician",
            "start_at": "16:45:00",
            "end_at": "18:00:00",
            "hours": 1.25,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 50,
        "task_id": 405,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 405,
            "name": "Log Grader and Scaler",
            "start_at": "11:00:00",
            "end_at": "11:15:00",
            "hours": 0.25,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 51,
        "task_id": 407,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 407,
            "name": "Recyclable Material Collector",
            "start_at": "08:15:00",
            "end_at": "09:00:00",
            "hours": 0.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 52,
        "task_id": 409,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 409,
            "name": "Home Entertainment Equipment Installer",
            "start_at": "13:15:00",
            "end_at": "13:30:00",
            "hours": 0.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 53,
        "task_id": 423,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 423,
            "name": "Paving Equipment Operator",
            "start_at": "10:00:00",
            "end_at": "11:00:00",
            "hours": 1,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 54,
        "task_id": 426,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 426,
            "name": "Conveyor Operator",
            "start_at": "08:45:00",
            "end_at": "10:15:00",
            "hours": 1.5,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 55,
        "task_id": 439,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 439,
            "name": "Forest Fire Inspector",
            "start_at": "11:15:00",
            "end_at": "13:15:00",
            "hours": 2,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 56,
        "task_id": 441,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 441,
            "name": "Petroleum Pump Operator",
            "start_at": "10:30:00",
            "end_at": "12:30:00",
            "hours": 2,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 57,
        "task_id": 444,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 444,
            "name": "Industrial Equipment Maintenance",
            "start_at": "08:15:00",
            "end_at": "09:15:00",
            "hours": 1,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 58,
        "task_id": 445,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 445,
            "name": "Extruding Machine Operator",
            "start_at": "11:15:00",
            "end_at": "12:00:00",
            "hours": 0.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 59,
        "task_id": 446,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 446,
            "name": "Heaters",
            "start_at": "15:45:00",
            "end_at": "17:15:00",
            "hours": 1.5,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 60,
        "task_id": 451,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 451,
            "name": "Waitress",
            "start_at": "17:00:00",
            "end_at": "18:45:00",
            "hours": 1.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 61,
        "task_id": 457,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 457,
            "name": "HVAC Mechanic",
            "start_at": "13:00:00",
            "end_at": "14:30:00",
            "hours": 1.5,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 62,
        "task_id": 463,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 463,
            "name": "Vending Machine Servicer",
            "start_at": "17:00:00",
            "end_at": "18:15:00",
            "hours": 1.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 63,
        "task_id": 465,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 465,
            "name": "Photoengraver",
            "start_at": "12:15:00",
            "end_at": "13:45:00",
            "hours": 1.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 64,
        "task_id": 473,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 473,
            "name": "Auditor",
            "start_at": "08:30:00",
            "end_at": "09:30:00",
            "hours": 1,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 65,
        "task_id": 476,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 476,
            "name": "Health Specialties Teacher",
            "start_at": "16:00:00",
            "end_at": "17:00:00",
            "hours": 1,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 66,
        "task_id": 481,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 481,
            "name": "Transportation Equipment Painters",
            "start_at": "08:00:00",
            "end_at": "08:15:00",
            "hours": 0.25,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 67,
        "task_id": 485,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 485,
            "name": "Electronic Drafter",
            "start_at": "08:15:00",
            "end_at": "10:00:00",
            "hours": 1.75,
            "date": "2020-07-02 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 68,
        "task_id": 488,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 488,
            "name": "Statistical Assistant",
            "start_at": "15:00:00",
            "end_at": "16:15:00",
            "hours": 1.25,
            "date": "2020-07-03 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 69,
        "task_id": 490,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 490,
            "name": "Social Scientists",
            "start_at": "13:45:00",
            "end_at": "14:15:00",
            "hours": 0.5,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 853,
        "task_id": 117,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 117,
            "name": "Landscape Artist",
            "start_at": "09:30:00",
            "end_at": "09:45:00",
            "hours": 0.25,
            "date": "2020-07-01 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    }
]</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/user/{user}/bid/{conference}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>The user's id</td>
</tr>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<!-- END_621dcdc4770a45b8129b12966db31c4d -->
<!-- START_dee066b50e1d0aff9f737cddd2f56f4f -->
<h2>Get all notifications for a user of a given conference</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/user/1/notification/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/user/1/notification/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "total": 2,
    "notifications": [
        {
            "id": "f8f02574-a9eb-408b-9836-c7408b248afb",
            "type": "App\\Notifications\\Announcement",
            "data": {
                "elements": [
                    {
                        "type": "action",
                        "data": {
                            "caption": "Click to view",
                            "url": "https:\/\/chisv.org\/conference\/chi20"
                        }
                    }
                ],
                "subject": "SV Announcement",
                "greeting": null,
                "salutation": "Regards,\n\nSV Chairs CHI20, Honolulu, Hawaiʻi, USA\n\n[noreply@chisv.org](mailto:noreply@chisv.org)\n\n[ACM](https:\/\/www.acm.org\/)"
            },
            "read_at": null,
            "created_at": "2020-07-06 18:11:53"
        },
        {
            "id": "05f4e434-6efb-4559-9081-d67ecdd0bc8b",
            "type": "App\\Notifications\\Announcement",
            "data": {
                "elements": [
                    {
                        "type": "action",
                        "data": {
                            "caption": "Click to view",
                            "url": "https:\/\/chisv.org\/conference\/chi20"
                        }
                    }
                ],
                "subject": "SV Announcement",
                "greeting": null,
                "salutation": "Regards,\n\nSV Chairs CHI20, Honolulu, Hawaiʻi, USA\n\n[noreply@chisv.org](mailto:noreply@chisv.org)\n\n[ACM](https:\/\/www.acm.org\/)"
            },
            "read_at": null,
            "created_at": "2020-07-06 18:11:53"
        }
    ]
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/user/{user}/notification/{conference}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>The user's id</td>
</tr>
<tr>
<td><code>conference</code></td>
<td>required</td>
<td>The conference's key</td>
</tr>
</tbody>
</table>
<!-- END_dee066b50e1d0aff9f737cddd2f56f4f -->
<!-- START_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->
<h2>Get all users</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/user?university_id=4044&amp;university_fallback=%22Aachen%22&amp;search=%22Admin%22&amp;sort_by=lastname&amp;sort_order=asc&amp;per_page=2&amp;page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/user"
);

let params = {
    "university_id": "4044",
    "university_fallback": ""Aachen"",
    "search": ""Admin"",
    "sort_by": "lastname",
    "sort_order": "asc",
    "per_page": "2",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "firstname": "ADMIN Milton",
            "lastname": "Waddams",
            "email": "admin@chisv.org",
            "university_id": "4011",
            "university_fallback": null,
            "university": {
                "id": 4011,
                "name": "Rajasthan Technical University"
            },
            "permissions": [
                {
                    "user_id": 1,
                    "conference_id": null,
                    "role": {
                        "id": 1,
                        "name": "admin",
                        "description": "Can do anything"
                    },
                    "state": null,
                    "conference": null
                },
                {
                    "user_id": 1,
                    "conference_id": 1,
                    "role": {
                        "id": 10,
                        "name": "sv",
                        "description": "Is associated for conferences as SV"
                    },
                    "state": {
                        "id": 11,
                        "name": "enrolled",
                        "description": "Waiting to be accepted, waitlisted or dropped"
                    },
                    "conference": {
                        "id": 1,
                        "name": "CHI 2020",
                        "key": "chi20"
                    }
                }
            ]
        }
    ],
    "first_page_url": "http:\/\/localhost:8000\/api\/v1\/user?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost:8000\/api\/v1\/user?page=1",
    "next_page_url": null,
    "path": "http:\/\/localhost:8000\/api\/v1\/user",
    "per_page": "25",
    "prev_page_url": null,
    "to": 1,
    "total": 1
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/user</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>university_id</code></td>
<td>optional</td>
<td>int Limit to university by id</td>
</tr>
<tr>
<td><code>university_fallback</code></td>
<td>optional</td>
<td>string Limit to university by name</td>
</tr>
<tr>
<td><code>search</code></td>
<td>optional</td>
<td>string Search users by name</td>
</tr>
<tr>
<td><code>sort_by</code></td>
<td>optional</td>
<td>string Sort by column</td>
</tr>
<tr>
<td><code>sort_order</code></td>
<td>optional</td>
<td>string Sort order</td>
</tr>
<tr>
<td><code>per_page</code></td>
<td>optional</td>
<td>int Results per page</td>
</tr>
<tr>
<td><code>page</code></td>
<td>optional</td>
<td>int Show page</td>
</tr>
</tbody>
</table>
<!-- END_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->
<!-- START_a8f148df1f2cd4bc2d67314d2cb9fa3d -->
<h2>Get a user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "firstname": "ADMIN Milton",
    "lastname": "Waddams",
    "country_id": "82",
    "university_fallback": null,
    "shirt_id": "1",
    "degree_id": "2",
    "email": "admin@chisv.org",
    "locale_id": "40",
    "past_conferences": null,
    "past_conferences_sv": null,
    "region_id": "1269",
    "location": {
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1269,
            "name": "North Rhine-Westphalia"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        }
    },
    "avatar": null,
    "languages": [
        {
            "id": 10,
            "name": "Bashkir",
            "code": "ba",
            "pivot": {
                "user_id": "1",
                "language_id": "10"
            }
        },
        {
            "id": 13,
            "name": "Bihari",
            "code": "bh",
            "pivot": {
                "user_id": "1",
                "language_id": "13"
            }
        }
    ],
    "permissions": [
        {
            "id": 14,
            "user_id": 1,
            "conference_id": 1,
            "enrollment_form_id": 14,
            "conference": {
                "id": 1,
                "key": "chi20",
                "name": "CHI 2020",
                "state_id": 4,
                "state": {
                    "id": 4,
                    "name": "running",
                    "description": "The conference is running"
                },
                "artwork": null
            },
            "role": {
                "id": 10,
                "name": "sv",
                "description": "Is associated for conferences as SV"
            },
            "state": {
                "id": 12,
                "name": "accepted",
                "description": "Accepted to the conference as SV"
            },
            "enrollment_form": {
                "id": 14,
                "name": "Default",
                "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":false,\"weight\":0,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":0,\"weight\":0,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":2,\"weight\":0,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":true,\"weight\":0,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"sd\",\"required\":true}}}"
            },
            "user": {
                "id": 1
            }
        },
        {
            "id": 12,
            "user_id": 1,
            "conference_id": null,
            "enrollment_form_id": null,
            "conference": null,
            "role": {
                "id": 1,
                "name": "admin",
                "description": "Can do anything"
            },
            "state": null,
            "enrollment_form": null,
            "user": {
                "id": 1
            }
        }
    ],
    "locale": {
        "id": 40,
        "code": "en",
        "name": "English (United States)"
    },
    "university": {
        "id": 4011,
        "name": "Rajasthan Technical University",
        "url": "http:\/\/www.rtu.ac.in\/"
    },
    "city": {
        "id": 12850,
        "name": "Aachen"
    },
    "country": {
        "id": 82,
        "name": "Germany"
    },
    "region": {
        "id": 1269,
        "name": "North Rhine-Westphalia"
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/user/{user}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>optional</td>
<td>The user's id</td>
</tr>
</tbody>
</table>
<!-- END_a8f148df1f2cd4bc2d67314d2cb9fa3d -->
<!-- START_1006d782d67bb58039bde349972eb2f0 -->
<h2>Update a user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do" \
    -d '{"firstname":"Jacob","lastname":"Smith","email":"jacob@example.com","languages":[{"id":23}],"location":{"country":{"id":82,"name":"Germany"},"region":{"id":1268,"name":"Nordrhein-Westfalen"},"city":{"id":12850,"name":"Aachen"}},"university":{"id":4044,"name":"RWTH Aachen"},"degree_id":2,"shirt_id":3,"locale_id":51,"past_conferences":["CHI 2019"],"past_conferences_sv":["CHI 2019"],"password":"secret","password_confirmation":"secret"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

let body = {
    "firstname": "Jacob",
    "lastname": "Smith",
    "email": "jacob@example.com",
    "languages": [
        {
            "id": 23
        }
    ],
    "location": {
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        }
    },
    "university": {
        "id": 4044,
        "name": "RWTH Aachen"
    },
    "degree_id": 2,
    "shirt_id": 3,
    "locale_id": 51,
    "past_conferences": [
        "CHI 2019"
    ],
    "past_conferences_sv": [
        "CHI 2019"
    ],
    "password": "secret",
    "password_confirmation": "secret"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 1,
        "firstname": "Jacob",
        "lastname": "Smith",
        "country_id": 82,
        "university_id": 4044,
        "university_fallback": null,
        "shirt_id": 3,
        "degree_id": 2,
        "email": "jacob@example.com",
        "email_verified_at": "2020-07-04 14:12:30",
        "locale_id": 51,
        "created_at": "2020-07-04 14:12:30",
        "updated_at": "2020-07-06 20:52:29",
        "past_conferences": [
            "CHI 2019"
        ],
        "past_conferences_sv": [
            "CHI 2019"
        ],
        "region_id": 1268,
        "city_id": 12850,
        "location": {
            "country": {
                "id": 82,
                "name": "Germany"
            },
            "region": {
                "id": 1268,
                "name": "Nordrhein-Westfalen"
            },
            "city": {
                "id": 12850,
                "name": "Aachen"
            }
        },
        "languages": [
            {
                "id": 10,
                "name": "Bashkir",
                "code": "ba",
                "pivot": {
                    "user_id": "1",
                    "language_id": "10"
                }
            },
            {
                "id": 13,
                "name": "Bihari",
                "code": "bh",
                "pivot": {
                    "user_id": "1",
                    "language_id": "13"
                }
            }
        ],
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        },
        "avatar": null,
        "permissions": [
            {
                "id": 12,
                "user_id": 1,
                "conference_id": null,
                "created_at": "2020-07-04 14:12:31",
                "updated_at": "2020-07-04 14:12:31",
                "enrollment_form_id": null,
                "lottery_position": null,
                "conference": null,
                "role": {
                    "id": 1,
                    "name": "admin",
                    "description": "Can do anything"
                },
                "state": null
            },
            {
                "id": 14,
                "user_id": 1,
                "conference_id": 1,
                "created_at": "2020-07-06 17:17:10",
                "updated_at": "2020-07-06 20:32:37",
                "enrollment_form_id": 14,
                "lottery_position": null,
                "conference": {
                    "id": 1,
                    "name": "CHI 2020",
                    "key": "chi20",
                    "location": "Honolulu, Hawaiʻi, USA",
                    "timezone_id": 366,
                    "start_date": "2020-07-01",
                    "end_date": "2020-07-07",
                    "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
                    "enrollment_form_id": 1,
                    "state_id": 4,
                    "url": "https:\/\/www.acm.org\/",
                    "url_name": "ACM",
                    "created_at": "2020-07-04 14:12:29",
                    "updated_at": "2020-07-06 20:38:18",
                    "volunteer_hours": 20,
                    "volunteer_max": 100,
                    "email_chair": "noreply@chisv.org",
                    "bidding_start": "2020-07-01",
                    "bidding_end": "2020-07-23",
                    "bidding_enabled": true,
                    "artwork": null
                },
                "role": {
                    "id": 10,
                    "name": "sv",
                    "description": "Is associated for conferences as SV"
                },
                "state": {
                    "id": 12,
                    "name": "accepted",
                    "for": "App\\User",
                    "description": "Accepted to the conference as SV"
                }
            }
        ],
        "university": {
            "id": 4044,
            "name": "Rheinisch Westfälische Technische Hochschule Aachen",
            "url": "http:\/\/www.rwth-aachen.de\/"
        }
    },
    "message": "User updated"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/user/{user}</code></p>
<p><code>PATCH api/v1/user/{user}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>optional</td>
<td>int required The user's id</td>
</tr>
</tbody>
</table>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>firstname</code></td>
<td>string</td>
<td>required</td>
<td>The user's first name</td>
</tr>
<tr>
<td><code>lastname</code></td>
<td>string</td>
<td>required</td>
<td>The user's last name</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>The user's email</td>
</tr>
<tr>
<td><code>languages</code></td>
<td>array&lt;<a href="#get-all-languages-matching-a-pattern">Language</a>&gt;</td>
<td>optional</td>
<td>An array of languages</td>
</tr>
<tr>
<td><code>languages.*.id</code></td>
<td>integer</td>
<td>required</td>
<td>A <a href="#get-all-languages-matching-a-pattern">language's</a> id</td>
</tr>
<tr>
<td><code>location</code></td>
<td><a href="#get-all-locations-for-a-country-by-city-name">Location</a></td>
<td>required</td>
<td>The users location by city name</td>
</tr>
<tr>
<td><code>location.country.id</code></td>
<td>integer</td>
<td>required</td>
<td>The location's country id</td>
</tr>
<tr>
<td><code>location.country.name</code></td>
<td>string</td>
<td>optional</td>
<td>The location's country name</td>
</tr>
<tr>
<td><code>location.region.id</code></td>
<td>integer</td>
<td>optional</td>
<td>The location's region id</td>
</tr>
<tr>
<td><code>location.region.name</code></td>
<td>string</td>
<td>optional</td>
<td>The location's region name</td>
</tr>
<tr>
<td><code>location.city.id</code></td>
<td>integer</td>
<td>optional</td>
<td>The location's city id</td>
</tr>
<tr>
<td><code>location.city.name</code></td>
<td>string</td>
<td>optional</td>
<td>The location's city name</td>
</tr>
<tr>
<td><code>university.id</code></td>
<td>integer</td>
<td>optional</td>
<td>The <a href="#get-all-universities-matching-a-pattern">university's</a> id</td>
</tr>
<tr>
<td><code>university.name</code></td>
<td>string</td>
<td>optional</td>
<td>The fallback university's name if no id used (see above)</td>
</tr>
<tr>
<td><code>degree_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's <a href="#get-all-degrees">degree</a></td>
</tr>
<tr>
<td><code>shirt_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's <a href="#get-all-t-shirts">shirt</a></td>
</tr>
<tr>
<td><code>locale_id</code></td>
<td>integer</td>
<td>required</td>
<td>The user's <a href="#get-all-locales">locale</a></td>
</tr>
<tr>
<td><code>past_conferences</code></td>
<td>array&lt;string&gt;</td>
<td>optional</td>
<td>The user's past attended conferences as array</td>
</tr>
<tr>
<td><code>past_conferences.*</code></td>
<td>string</td>
<td>optional</td>
<td>A user's past attended conference</td>
</tr>
<tr>
<td><code>past_conferences_sv</code></td>
<td>array&lt;string&gt;</td>
<td>optional</td>
<td>The user's past attended conferences as SV as array</td>
</tr>
<tr>
<td><code>past_conferences_sv.*</code></td>
<td>string</td>
<td>optional</td>
<td>A user's past attended conference as SV</td>
</tr>
<tr>
<td><code>password</code></td>
<td>string</td>
<td>optional</td>
<td>The user's password</td>
</tr>
<tr>
<td><code>password_confirmation</code></td>
<td>string</td>
<td>optional</td>
<td>The user's password</td>
</tr>
</tbody>
</table>
<!-- END_1006d782d67bb58039bde349972eb2f0 -->
<!-- START_a5d7655acadc1b6c97d48e68f1e87be9 -->
<h2>Delete a user</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "This action is unauthorized."
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/user/{user}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>user</code></td>
<td>required</td>
<td>The user's id</td>
</tr>
</tbody>
</table>
<!-- END_a5d7655acadc1b6c97d48e68f1e87be9 -->
<h1>general</h1>
<!-- START_4fd9bbcd39c117c54c591475d46e0cec -->
<h2>api/v1/conference/{conference}/sv/count</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://chisv.org/api/v1/conference/1/sv/count" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference/1/sv/count"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "No query results for model [App\\Conference] 1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/conference/{conference}/sv/count</code></p>
<!-- END_4fd9bbcd39c117c54c591475d46e0cec -->
<!-- START_f3a734edd078d86bac9e759001b1131b -->
<h2>Store a newly created resource in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/conference" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/conference"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "The given data was invalid.",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "key": [
            "The key field is required."
        ]
    }
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/conference</code></p>
<!-- END_f3a734edd078d86bac9e759001b1131b -->
<!-- START_7a258424680b47d440023731a4e0be3e -->
<h2>Store a newly created resource in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://chisv.org/api/v1/assignment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/assignment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Server Error"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/assignment</code></p>
<!-- END_7a258424680b47d440023731a4e0be3e -->
<!-- START_7d20a674615f823ca955430b9ac0ebe1 -->
<h2>Update the specified resource in storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://chisv.org/api/v1/assignment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/assignment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": {
        "id": 1,
        "user_id": 1,
        "task_id": 156,
        "hours": "1.0",
        "state_id": 41,
        "created_at": "2020-07-06 16:44:00",
        "updated_at": "2020-07-06 16:44:00",
        "state": {
            "id": 41,
            "name": "assigned",
            "for": "App\\Assignment",
            "description": "The task is assigned but yet not being worked on"
        }
    },
    "message": "Assignment updated"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/assignment/{assignment}</code></p>
<p><code>PATCH api/v1/assignment/{assignment}</code></p>
<!-- END_7d20a674615f823ca955430b9ac0ebe1 -->
<!-- START_08760017a44835569ff03aaa51b16be8 -->
<h2>Remove the specified resource from storage.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X DELETE \
    "https://chisv.org/api/v1/assignment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://chisv.org/api/v1/assignment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiNmQ1ZTQ3ZmQyYjNhYjc4Y2Q0YWM4MDYxZDNiNjI5YjA1NTM2NTViNGRlOGVlZjg2YWM2ZDA1OTk2OTFhYjVhNGNmMzUxMzdmMDE4NGY2In0.eyJhdWQiOiIyIiwianRpIjoiOGI2ZDVlNDdmZDJiM2FiNzhjZDRhYzgwNjFkM2I2MjliMDU1MzY1NWI0ZGU4ZWVmODZhYzZkMDU5OTY5MWFiNWE0Y2YzNTEzN2YwMTg0ZjYiLCJpYXQiOjE1OTQwNDI1NjQsIm5iZiI6MTU5NDA0MjU2NCwiZXhwIjoxNjI1NTc4NTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iouAe2tM-Aj57Wwg-E1-jhS9y_xLUARMFpzJN_vXoeB2rTnOW2YMrPjrzmO7Le-W4uQGpdyfEsYMrEzc2RLToNBEK0-8Sc2X6ONS1U4Eh0NNIBP6e1WSO3Kc2KBKR9cKEVAZtbvNoagPnraNdDr-ucNTIpbckeb_v-uu_ZQmcvb9NtaCOVMGRskNKNfDPgcVhe87Hyfa3bwQq7J2iZT_hDHYgCurNcljiX_jj8VOvViE1P8HBVOhKT2ZGPJ8c-FpPlhGRZGyjtOk6bd_wFTm-Nc_8qoonlZkQo0DbWtWSnBlj-jyjYaPNeDCNEX4IT8288GSH11l79i54_6nSZgOpTMID2BjoV_WK3JkL8MPMFIsTWI1PWtG_zJtH5Usu9W3bz5d6rJOS0t8Y4Sm3kw6PGunKI0YfDHoD20d3zKRs5e7FT1wswliZQ_28Y5vQagwRMTQhPNgtw3T9vMQluI-oaOyq5SkRnoElHjfzNZMwvn5KfrYoARWWl_TvccQNvWvNjYFRRJlE0Mx3Hj1CdBfJcdwv1V6S84FTl296ViWCRc1AfRitpMcz5zPytH4gaiP-4oyYB5VEiryVZ1y2L_OyS_J5wYJjxhuDP4RW9oR5AKPP9TIIGd0B_WU13LoLX2MTrd1AAg1pupBJQi_0WedKCUCXf87sbNPdHvRzUKW8Do",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "result": true,
    "message": "Assignment removed"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/assignment/{assignment}</code></p>
<!-- END_08760017a44835569ff03aaa51b16be8 -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                              </div>
                </div>
    </div>
  </body>
</html>