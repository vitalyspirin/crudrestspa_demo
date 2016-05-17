var Utils = 
{
    getDateStrFromMySQLDateTime :   function(mySQLDateTimeStr)
    {
        var isoDateTime = mySQLDateTimeStr.replace(' ', 'T');
        var dateTime = new Date(Date.parse(isoDateTime));

        var dateStr = '' + dateTime.getFullYear() + dateTime.getMonth() + 
            dateTime.getDate();

        return dateStr;
    },
 
    getMySQLDateFromJSDate  : function(d)
    {
        function pad(n){return n<10 ? '0'+n : n}

        return d.getFullYear()+'-'
          + pad(d.getMonth()+1)+'-'
          + pad(d.getDate()) +' '
          + pad(d.getHours())+':'
          + pad(d.getMinutes())+':'
          + pad(d.getSeconds());
    },
    
    getDateFromJSDateTime   : function(d)
    {
        function pad(n){return n<10 ? '0'+n : n}
        
        return d.getFullYear()+'-'
          + pad(d.getMonth()+1)+'-'
          + pad(d.getDate());
    },
    
    
    getJSDateFromMySQLDateTime: function(datetimeStr)
    {
        var newDateTimeStr = datetimeStr.replace(/-/g, '/');
        var result = new Date(newDateTimeStr);
        
        return result;
    }
    
    
}
