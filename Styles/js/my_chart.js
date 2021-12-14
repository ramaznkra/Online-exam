
var totalStudent = document.getElementById('totalStudent').getContext('2d');
var totalQuestion = document.getElementById('totalQuestion').getContext('2d');
var examStatus = document.getElementById('examStatus').getContext('2d');

var  totalStudent = new Chart(totalStudent, {
    type: 'doughnut',
    data: {
        labels:['Chatbot','Chat'],
        datasets: [{
            label: '# of Votes',
            data:[732,834],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    }

});
var  totalQuestion = new Chart(totalQuestion, {
    type: 'doughnut',
    data: {
        labels:['Açık','Kapalı'],
        datasets: [{
            label: '# of Votes',
            data:[64,4],
            backgroundColor: ['rgba(75, 192, 192, 1)','rgba(255, 159, 64, 1)'],
            borderColor: ['rgba(75, 192, 192, 1)','rgba(255, 159, 64, 1)'],
            borderWidth: 1
        }]
    }

});
var  examStatus = new Chart(examStatus, {
    type: 'line',
    data: {
        labels:['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'],
        datasets: [{
            label:["Aylık Açılan Konuşma Sayısı"],
            data:[0,0,0,0,0,24,121,218,261,173,35,0],
            backgroundColor:[ 'rgba(54, 162, 235, 1)'],
            borderColor: [ 'rgba(54, 162, 235, 1)'],
            borderWidth: 1,
            fill: false,
            tension: 0.4
        }]
    }

});
