// Bar chart
new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
        labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aûot", "Septembre", "Octobre", "Novembre", "Décembre"],
        datasets: [
            {
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", "#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#c45850"],
                data: [2478,5267,734,784,433,2478,5267,734,784,433,784,784]
            }
        ]
    },
    options: {
        legend: { display: false },
        title: {
            display: true,
        }
    }
});