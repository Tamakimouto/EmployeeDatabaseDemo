$(function() {

    var app = new Vue({
        el: "#home",
        data: {
            customQuery: "Custom Table Join",
            queries: [
                {name: "Department(s) with minimum number of employees", file: "php/minemployee.php"},
                {name: "Department(s) with maximum ratio of average female salaries to average men salaries", file: "php/file1.php"},
                {name: "Manager(s) who held office for the longest duration", file: "php/file2.php"},
                {name: "The number of employees born in each decade and their average salaries for each Dept", file: "php/file3.php"},
                {name: "Female managers born before 1990, that make more than 80,000 a year", file: "php/file4.php"}
            ],
            result: ""
        },
        methods: {
            runAjax: function(file) {
                this.result = file;
                $.ajax({
                    url: file
                })
            }
        }
    });
});
