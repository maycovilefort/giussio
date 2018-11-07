var randomnb = function () {
    return Math.round(Math.random() * 100);
};

var options = {
    responsive: true,
    //Boolean - Whether we should show a stroke on each segment
    
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#252830",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 2,
    
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 80, // This is 0 for Pie charts
    //Number - Amount of animation steps
    
    animationSteps: 50,
    // String - Animation easing effect
    // Possible effects are:
    // [easeInOutQuart, linear, easeOutBounce, easeInBack, easeInOutQuad,
    //  easeOutQuart, easeOutQuad, easeInOutBounce, easeOutSine, easeInOutCubic,
    //  easeInExpo, easeInOutBack, easeInCirc, easeInOutElastic, easeOutBack,
    //  easeInQuad, easeInOutExpo, easeInQuart, easeOutQuint, easeInOutCirc,
    //  easeInSine, easeOutExpo, easeOutCirc, easeOutCubic, easeInQuint,
    //  easeInElastic, easeInOutSine, easeInOutQuint, easeInBounce,
    //  easeOutElastic, easeInCubic]
    animationEasing: "easeInOutQuad",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false
};
var data1 = [
    {value: randomnb(), color: "#1CA8DD", highlight: "#1CA8DD", label: "Azul"},
    {value: randomnb(), color: "#1BC98E", highlight: "#1BC98E", label: "Verde"}
];
var data2 = [
    {value: randomnb() * 0.75, color: "#1CA8DD", highlight: "#1CA8DD", label: "Azul"},
    {value: randomnb() * 0.75, color: "#1BC98E", highlight: "#1BC98E", label: "Verde"}
];
var data3 = [
    {value: randomnb() * 0.50, color: "#1CA8DD", highlight: "#1CA8DD", label: "Azul"},
    {value: randomnb() * 0.50, color: "#1BC98E", highlight: "#1BC98E", label: "Verde"}
];
window.onload = function () {
    var ctx = document.getElementById("grafico1").getContext("2d");
    var PizzaChart = new Chart(ctx).Doughnut(data1, options);
    var ctx = document.getElementById("grafico2").getContext("2d");
    var PizzaChart = new Chart(ctx).Doughnut(data2, options);
    var ctx = document.getElementById("grafico3").getContext("2d");
    var PizzaChart = new Chart(ctx).Doughnut(data3, options);
};