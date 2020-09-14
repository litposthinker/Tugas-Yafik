var questions = [{
    question: 'Palu Thor, Mjolnir terbuat dari logam yang berasal dari inti benda mati apa?',
    answers: [{
        text: 'Bintang',
        correct: true
      },
      {
        text: 'Komet',
        correct: false
      },
      {
        text: 'Planet',
        correct: false
      },
      {
        text: 'Asteroid',
        correct: false
      }
    ]
  },
  {
    question: 'Siapa nama musuh utama di Marvel Studios’ Ant-Man?',
    answers: [{
        text: 'The Wasp',
        correct: false
      },
      {
        text: 'Hornet',
        correct: false
      },
      {
        text: 'Yellow Jacket',
        correct: true
      },
      {
        text: 'Ghost',
        correct: false
      }
    ]
  },
  {
    question: 'Dalam kredit scene dari Film Marvel The Avengers, di restoran makan apakah para Avengers?',
    answers: [{
        text: 'Pizza',
        correct: false
      },
      {
        text: 'Shawarma',
        correct: true
      },
      {
        text: 'Sushi',
        correct: false
      },
      {
        text: 'Fried Chicken',
        correct: false
      }
    ]
  },
  {
    question: 'Dimanakah Thanos menemukan Soul Stone?',
    answers: [{
        text: 'Vormir',
        correct: true
      },
      {
        text: 'Knowhere',
        correct: false
      },
      {
        text: 'Earth',
        correct: false
      },
      {
        text: 'Nidavellir',
        correct: false
      },
    ]
  }
]

var pertanyaan = questions.map(function (pertanyaan) {
  return pertanyaan.question
});
var tanya = questions.map(function (pertanyaan) {
  return pertanyaan.answers.map(function (jawaban) {
    return jawaban.text
  });
});
var correct = questions.map(function (pertanyaan) {
  return pertanyaan.answers.map(function (jawaban) {
    return jawaban.correct
  });
});

var timer = document.getElementById("count")
var quest = document.getElementById("quest")
var btn1 = document.getElementById("btn1")
var btn2 = document.getElementById("btn2")
var btn3 = document.getElementById("btn3")
var btn4 = document.getElementById("btn4")
var button = document.getElementById("button")

var answer = []
var jawaban = []

var click = 0

function clickbtn(value) {
  answer.splice(0, 1, correct[click][value])
}

button.style.visibility = "hidden";

function time() {
  var timeleft = 10;
  var loop = 0
  var downloadTimer = setInterval(function () {
    if (timeleft >= 0) {
      button.style.visibility = "visible";
      timer.innerHTML = timeleft;
      quest.innerHTML = pertanyaan[loop]
      btn1.innerHTML = tanya[loop][0]
      btn2.innerHTML = tanya[loop][1]
      btn3.innerHTML = tanya[loop][2]
      btn4.innerHTML = tanya[loop][3]

      timeleft--
    } else if (loop == 3) {
      jawaban = jawaban.concat(answer[0])
      var nilai = 0
      for (var i = 0; i < jawaban.length; i++) {
        if (jawaban[i] == true) {
          nilai++
        } else {
          continue
        }
      };
      button.style.visibility = "hidden";
      timer.innerHTML = "Hasil"
      quest.innerHTML = "Anda mendapatkan skor " + nilai + " poin"


      clearInterval(downloadTimer)
    } else if (timeleft < 0) {
      jawaban = jawaban.concat(answer[0])
      button.style.visibility = "hidden";
      quest.innerHTML = ""
      timer.innerHTML = ""

      timeleft = 10
      loop++
      click++
    }
  }, 1000);
}
time()