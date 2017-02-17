$(function() {

    var app = new Vue({
        el: "#home",
        data: {
            queries: [
                {name: "Department(s) with minimum number of employees", file: "php/Query1.php"},
                {name: "Department(s) with maximum ratio of average female salaries to average men salaries", file: "php/Query2.php"},
                {name: "Manager(s) who held office for the longest duration", file: "php/Query3.php"},
                {name: "The number of employees born in each decade and their average salaries for each Dept", file: "php/file3.php"},
                {name: "Female managers born before 1990, that make more than 80,000 a year", file: "php/file4.php"}
            ],
            customQuery: "Some of our awesome people!",
            result: ""
        },
        methods: {
            runAjax: function(file) {
                $.ajax({
                    type: "POST",
                    url: file,
                    success: function(res) {
                        switch (res["query"]) {
                            case 1:
                                res["data"].forEach(function(entry) {
                                    app.result += entry["department"] + " ";
                                });
                                app.result = "The department(s) with the fewest employees is " + app.result;
                                break;
                            default:
                                app.result = "Yo, some error occured.";
                                break;
                        }
                    } // Ajax Success
                });
            }
        }
    });
});
