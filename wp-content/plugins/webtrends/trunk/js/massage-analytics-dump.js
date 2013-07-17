function fromAnalyticsDumpToFlotData(dump) {
    // little helper for extracting attributes of an object
    function getAttributes(o) {
        var res = [];
        for (var a in o)
            res.push(a);
        return res;
    }

    var collected = {};

    var dateRange = getAttributes(dump.data)[0];
    // the rows are under the data under the specific date range
    // (we assume there's one range only)
    var rows = dump.data[dateRange].SubRows;

    // now collect the data points, grouping by measure
    for (var date in rows) {
        var t = date.split('/'), d = new Date();
        d.setUTCFullYear(parseInt(t[2], 10));
        d.setUTCMonth(parseInt(t[0], 10) - 1);
        d.setUTCDate(parseInt(t[1], 10));
        d.setUTCHours(0);
        d.setUTCMinutes(0);
        d.setUTCSeconds(0);
        d.setUTCMilliseconds(0);

        var timestamp = d.getTime();

        for (var m in rows[date].measures) {
            if (!collected[m])
                collected[m] = [];

            collected[m].push([timestamp, parseFloat(rows[date].measures[m])]);
        }
    }

    // now massage it into Flot dataset
    var res = [];
    for (var measure in collected) {
        // sort by the timestamps
        collected[measure].sort(function (a, b) { return a[0] - b[0]; });

        var d = {};
        d.label = measure;
        d.data = collected[measure];
        
        res.push(d);
    }
    
    return res;
}
