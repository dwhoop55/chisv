/**
 * Pad numbers to two digits
 **/
function twoDigits(d) {
    if (0 <= d && d < 10) return "0" + d.toString();
    if (-10 < d && d < 0) return "-0" + (-1 * d).toString();
    return d.toString();
}

/**
 * Prototype to output MySQL date format
 **/
Date.prototype.toMySqlDate = function () {
    return (
        this.getFullYear() +
        "-" +
        twoDigits(1 + this.getMonth()) +
        "-" +
        twoDigits(this.getDate())
    );
};


Date.prototype.toMySqlDateTime = function () {
    return (
        this.getFullYear() +
        "-" +
        twoDigits(1 + this.getMonth()) +
        "-" +
        twoDigits(this.getDate()) +
        " " +
        twoDigits(this.getHours()) +
        ":" +
        twoDigits(this.getMinutes()) +
        ":" +
        twoDigits(this.getSeconds())
    );
};

Date.prototype.toMySqlTime = function () {
    return (
        twoDigits(this.getHours()) +
        ":" +
        twoDigits(this.getMinutes()) +
        ":" +
        twoDigits(this.getSeconds())
    );
};

Array.prototype.column = function (column) {
    return this.map(function (value, index) {
        return value[column];
    });
}