<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="container-fluid back-gray card-slider subjects">
	<div class="row justify-content-center mb-4">
		<div class="col-md-3">
			<h3 class="title">Shastra</h3>
		</div>
	</div>
	<div class="row justify-content-center mb-5 card-deck">
			<div class="card-body">
            <ul id="myUL">
                <li><span class="caret">Darśana	</span>
                <ul class="nested">
                <li><span class="caret">Āstikadarśana</span>
                <ul class="nested">
                <li>Sāṅkhya</li>
                <li>Yoga</li>
                <li><span class="caret">Nyāya</span>
                <ul class="nested">
                <li>Prācīnanyāya</li>
                <li>Navyanyāya</li>
                </ul>
                </li>
                <li>Vaiśeṣika</li>
                <li>Pūrvamīmāṁsā
                <li><span class="caret">Uttaramīmāṁsā (Vedānta)</span>
                <ul class="nested">
                <li>Advaita vedanta</li>
                <li><span class="caret">Dvaita-vedānta</span>
                <ul class="nested">
                <li>Madhvavedānta</li>
                <li>Acintyabhedā-bheda Darśana</li>
                <li>Śaivāgama Darśana</li>
                </ul>
                <li>Dvaitādvaita-vedānta</li>
                </ul>
                </li>
                </ul>
                </li>
                <li><span class="caret">Nāstikadarśana</span>
                <ul class="nested">
                <li><span class="caret">Bauddha</span>
                <ul class="nested">
                <li>Sautrāntika</li>
                <li>Vaibhāṣika</li>
                <li>Mādhyamika</li>
                <li>Yogācāra</li>
                </ul>
                </li>
                <li>Jaina</span></li>
                <li>Charvaka</span></li>
            </li>
        </ul>
			</div>
			<div class="card-body">
            <ul id="myUL">
                <li><span class="caret">Vyakarana Shastra</span>
                <ul class="nested">
                <li><span class="caret">Panini Sutra</span>
                <ul class="nested">
                <li><span class="caret">Mahabhashya</span>
                <ul class="nested">
                <li>Kaiyyata</li>
                <li>Udyota</li>
                </li></ul>
                </li>
                <li><span class="caret">Siddhanta Kaumudi</span>
                <ul class="nested">
                <li>Praudha Manorama</li>
                <li>Shabdendu Shekhara</li>
                </li></ul>
                <li>Kashika</li>
                <li><span class="caret">Other works</span>
                <ul class="nested">
                <li>Bhushana Saara</li>
                <li>Vaiyyakarana siddhanta laghu manjusha</li>
                <li>Paribhashendu shkekhara</li>
                </ul>
                </ul>
			
			</div>

		
		<div class="card-body">
        <ul id="myUL">
        <li><span class="caret">Jyotisha Shastra</span>
        <ul class="nested">
                <li><span class="caret">Phalitajyotiṣa</span>
                <ul class="nested">
                <li>Graha-vijñāna</li>
                <li>Horā</li>
                <li>Jātaka</li>
                <li>Tithi</li>
                <li>Muhūrta</li>
                <li>Praśna</li>
                <li>Ramala</li>
                <li>Ratna</li>
                <li>Sāmudrika</li>
                <li>Svapna</li>
                <li>Svara</li>
                <li>Tājika</li>
                <li>Melaka</li>
                <li>Śubhāśubha-vicāra</li>
                </ul>
                </li>
                <li><span class="caret">Siddhānta-jyotiṣa</span>
                <ul class="nested">
                <li>Karaṇa</li>
                <li>Koṣṭhaka</li>
                <li>Pañcāṅga</li>
                <li>Yantra</li>
                <li>Gaṇita</li>
                </ul>
                </li>
                <li>Gaṇitajyotiṣa</li>
                </ul>
			</div>
    <!-- </div> -->
	<!-- <div class="row justify-content-center mb-3 card-deck"> -->
    <div class="card-body">
    <ul id="myUL">
                <li><span class="caret">Natya Shastra</span>
                <ul class="nested">
                <li>Natya Shastra - Bharatamuni</li>
                <li>Abhinaya Darpanam - Nandikeswara</li>
                <li>Abhinava Bharati </li>
                <li>Thandava Lakshanam </li>
                <li>Sri Hasta Muktavali</li>
                <li>Nritta Ratnavali</li>
                <li>Hasta Lakshana Deepika</li>
                <li>Dasharoopaka</li>
                <li>Rasa Manjari of Bhanudatta</li>
                <li>Abhinaya Svayambodhini</li>
                <li>Bhava Prakasa </li>
                <li>Natya Darpana</li>
                </ul>
                </li>
                </ul>
                </ul>
        </div>
        <div class="card-body">
        <ul id="myUL">
        <li><span class="caret">Ganita Shastra</span>
                <ul class="nested">
                <li>Vaidikagaṇita</li>
                <li>Bījagaṇita</li>
                <li>Pāṭigaṇita</li>
                <li>Rekhāgaṇita / Jyāmiti</li>
                <li>Mānaśāstra</li>
                <li>Parimiti</li>
                </ul>
                </ul>
        </ul>
        </div>
        <div class="card-body">
        <ul id="myUL">
        <li><span class="caret">Vijnana Shastra</span>
                <ul class="nested">
                <li>Bhūgolśāstra</li>
                <li>Khagolaśāstra</li>
                <li>Vanaṣpativijñāna</li>
                <li>Vāstuśāstra</li>
                <li>Rasaśāstra</li>
                <li>Lohaśāstra</li>
                <li>Vaimānikaśāstra</li>
                <li>Ratnaśāstra</li>
                <li>Kṛṣiśāstra</li>
                <li>Yantravijñāna</li>
                <li>Khanijavijñāna</li>
                <li>Vṛṣṭivijñāna</li>
                </ul>
                </ul>
        </ul>
        </div>
        <div class="card-body">
        <ul id="myUL">
                <li><span class="caret">Sangeeta Shastra</span>
                <ul class="nested">
                <li>Sangeeta Ratnakara - Saranga Deva</li>
                <li>Chaturdandi Prakashika - Venkatamakhin</li>
                <li>Sangeeta Sampradaya Pradarshini - Subbarama Dikshita</li>
                <li>Dhvanyaloka - Ananda Vardhana</li>
                <li>Sangita Parijata</li>
                <li>Sangeeta Damodara</li>
                <li>Brihaddesi</li>
                <li>Dattilam</li>
                <li>Gandharva Kalpavalli</li>
                <li>Gita Govindam</li>
                <li>Sangita Kalpadruma</li>
                <li>Sangita Makaranda </li>
                <li>Kitab -e Nauras</li>
                </ul>
                </li>
                </ul>
                </li>
                </ul>
                </li>
                </ul>
        </div>
    </div>
</div>
<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>