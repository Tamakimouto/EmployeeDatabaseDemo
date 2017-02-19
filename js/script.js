$(function() {

    var app = new Vue({
        el: "#home",
        data: {
            queries: [
                {name: "Department(s) with minimum number of employees", file: "php/Query1.php"},
                {name: "Department(s) with maximum ratio of average female salaries to average men salaries", file: "php/Query2.php"},
                {name: "Manager(s) who held office for the longest duration", file: "php/Query3.php"},
                {name: "The number of employees born in each decade and their average salaries for each Dept", file: "php/Query4.php"},
                {name: "Female managers born before 1990, that make more than 80,000 a year", file: "php/Query5.php"}
            ],
            customQuery: "Some of our awesome people!",
            departments: [],
            checkedDepts: [],
            result: "",
            people: ""
        },
        mounted: function() {
            $.ajax({
                type: "POST",
                url: "php/loadDepartments.php",
                success: function(res) {
                    res.forEach(function(dept) {
                        app.departments.push(dept);
                    });
                }
            });
        },
        methods: {
            runAjax: function(file) {
                app.result = "";
                $.ajax({
                    type: "POST",
                    url: file,
                    success: function(res) {
                        switch (res["query"]) {
                            case 1:
                                res["data"].forEach(function(entry) {
                                    app.result += ", " + entry["department"];
                                });
                                app.result = "The department(s) with the fewest employees is/are " + app.result;
                                break;
                            case 2:
                                res["data"].forEach(function(entry) {
                                    app.result += ", " + entry["department"] + " with a ratio of " + entry["ratio"] + " ";
                                });
                                app.result = "The department(s) with best ratio of female:male salaries is " + app.result;
                                break;
                            case 3:
                                res["data"].forEach(function(entry) {
                                    app.result += ", " + entry["firstName"] + " " + entry["lastName"];
                                });
                                app.result = "Our most experienced manager(s) are as follows" + app.result;
                                break;
                            case 4:
                                res["data"].forEach(function(entry) {
                                    app.result += "In the " + entry["department"] + " department, we have " +
                                        entry["count"] + " people born in " + entry["decade"] + " making " +
                                        entry["avgSalary"] + " on average. ";
                                });
                                break;
                            case 5:
                                res["data"].forEach(function(entry) {
                                    app.result += ", " + entry["firstName"] + " " + entry["lastName"];
                                });
                                app.result = "Here are some successful females in our Company " + app.result;
                                break;
                            default:
                                app.result = "Yo, some error occured.";
                                break;
                        }
                    } // Ajax Success
                });
            },
            runCustom: function() {
                app.people = [];
                $.ajax({
                    type: "POST",
                    data: {"departs": app.checkedDepts},
                    success: function(res) {
                        res.forEach(function(person) {
                            app.people.push(person["firstName"] + person["lastName"]);
                        });
                    }
                });
            }
        }
    });
});
