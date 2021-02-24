$(document).ready(function () {
    // auto fill phone number column in create form if exixts
    let phone = document.getElementById("phone_number_input");

    if (phone) {
        document.getElementById("phone_number_output").value = phone.value;
    }

    // Initialize the functions as soon as page loads
    customer_chart();
    credit_redeem_chart();
});

// Chart for Customers
function customer_chart() {
    let json_data = document.getElementById("customer_chart_data");

    if (json_data) {
        json_data = json_data.getAttribute("data-value");

        let customer_chart_data = JSON.parse(json_data);

        // customers_chart_data = sortObject(customer_chart_data);

        const apexChart = "#customers_chart";
        var options = {
            series: [
                {
                    name: "New Customers",
                    data: Object.values(customer_chart_data),
                },
            ],
            chart: {
                height: 350,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                categories: Object.keys(customer_chart_data),
            },
            colors: [primary, success],
        };

        var chart = new ApexCharts(document.querySelector(apexChart), options);
        chart.render();
    }
}

// Chart for credits and redeem points
function credit_redeem_chart() {
    let rewards_data = document.getElementById("rewards_data");

    if (rewards_data) {
        rewards_data = rewards_data.getAttribute("data-value");

        let rewards = JSON.parse(rewards_data);

        let credits = [];
        let redeem = [];

        for (let i in rewards) {
            credits.push(rewards[i]["credits"]);
            redeem.push(rewards[i]["redeem"]);
        }

        const apexChart = "#rewards_chart";
        var options = {
            series: [
                {
                    name: "Credit",
                    data: credits,
                },
                {
                    name: "Redeem",
                    data: redeem,
                },
            ],
            chart: {
                type: "bar",
                height: 350,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded",
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"],
            },
            xaxis: {
                categories: Object.keys(rewards),
            },
            yaxis: {
                title: {
                    text: "Points",
                },
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " points";
                    },
                },
            },
            colors: [primary, success, warning],
        };

        var chart = new ApexCharts(document.querySelector(apexChart), options);
        chart.render();
    }
}

// Auto refresh page when filter changes in dashboard page
function filter_charts_result() {
    document.getElementById("filter_form").submit();
}
