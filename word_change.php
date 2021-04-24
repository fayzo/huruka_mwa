
<?php include "core/init.php"; ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/fontawesome-free/css/all.min.css">
    
<style>

/* EXAMPLE NUMBER ONE */
/* EXAMPLE NUMBER ONE */
/* EXAMPLE NUMBER ONE */
.rw-wrapper{
width: 80%;
position: relative;
margin: 110px auto 0 auto;
font-family: 'Bree Serif';
padding: 10px;
}

.rw-sentence{
margin: 0;
text-align: left;
text-shadow: 1px 1px 1px rgba(255,255,255,0.8);
}

.rw-sentence span{
color: #444;
white-space: nowrap;
font-size: 200%;
font-weight: normal;
}

.rw-words{
display: inline;
text-indent: 10px;
}

.rw-words span{
position: absolute;
opacity: 0;
overflow: hidden;
width: 100%;
color: #6b969d;
}

.rw-words-1 span{
animation: rotateWordsFirst 18s linear infinite 0s;
}
.rw-words-2 span{
animation: rotateWordsSecond 18s linear infinite 0s;
}
.rw-words span:nth-child(2) { 
animation-delay: 3s; 
color: #6b889d;
}
.rw-words span:nth-child(3) { 
animation-delay: 6s; 
color: #6b739d; 
}
.rw-words span:nth-child(4) { 
animation-delay: 9s; 
color: #7a6b9d;
}
.rw-words span:nth-child(5) { 
animation-delay: 12s; 
color: #8d6b9d;
}
.rw-words span:nth-child(6) {  
animation-delay: 15s; 
color: #9b6b9d;
}

@keyframes rotateWordsFirst {
0% { opacity: 1; animation-timing-function: ease-in; height: 0px; }
8% { opacity: 1; height: 60px; }
19% { opacity: 1; height: 60px; }
25% { opacity: 0; height: 60px; }
100% { opacity: 0; }
}

@keyframes rotateWordsSecond {
0% { opacity: 1; animation-timing-function: ease-in; width: 0px; }
10% { opacity: 0.3; width: 0px; }
20% { opacity: 1; width: 100%; }
27% { opacity: 0; width: 100%; }
100% { opacity: 0; }
}

/* END OF EXAMPLE NUMBER 1 */
/* END OF EXAMPLE NUMBER 1 */

/* EXAMPLE 2 */
/* EXAMPLE 2 */

/* THIS IS FOR ANIMATE NEWS IN IRANGIRO */
/* THIS IS FOR ANIMATE NEWS IN IRANGIRO */

.banner {
    width: auto;
    display: inline-block;
    background:  #34ce0e;
    position: relative;
    margin-right: 10px;
}

.banner>h2 {
    display: inline-block;
    margin: 0;
    padding: 0 5px;
    font-size: 12px;
    color: #fff;
    /* height: 20px; */
    box-sizing: border-box
}

.banner > span {
    width: 0;
    position: absolute;
    right: -10px;
    top: 3px;
    height: 0;
    border-style: solid;
    /* border-width: 7px 0 7px 10px; */
    border-width: 6px 0 6px 10px;
    border-color: transparent transparent transparent  #34ce0e
    /*  #2096cd */
}

.ms-header {
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: sans-serif;
    width: 100vw;
    height: 100vh;
    background: linear-gradient(to right bottom, #9dd7d5, #fea096);
  }
  .ms-header__title {
    flex: 1 1 100%;
    width: 100%;
    text-align: center;
    /* font-size: 4rem; */
    font-size: 12px;
    font-weight: bold;
    /* color: #fff; */
    color: #4a4848;
    text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.4);
  }
  .ms-slider {
    display: inline-block;
    /* height: 1.5em; */
    height: 1.3em;
    /* width: 260px; */
    overflow: hidden;
    overflow-x: hidden;
    vertical-align: middle;
    mask-image: linear-gradient(transparent, white, white, white, transparent);
    mask-type: luminance;
    mask-mode: alpha;
  }
  .ms-slider__words {
    display: inline-block;
    margin: 0;
    padding: 0;
    list-style: none;
    animation-name: wordSlider;
    animation-timing-function: ease-out;
    animation-iteration-count: infinite;
    animation-duration: 7s;
  }
  .ms-slider__word {
    display: block;
    line-height: 1.3em;
    text-align: left;
  }

@keyframes wordSlider {
    0%, 27% {
      transform: translateY(0%);
    }
    33%, 60% {
      transform: translateY(-25%);
    }
    66%, 93% {
      transform: translateY(-50%);
    }
    100% {
      transform: translateY(-75%);
    }
  }
  /* END EXAMPLE2 */
  /* END EXAMPLE2 */
    </style>
</head>
<body>
example 1
    <section class="rw-wrapper">
        <h2 class="rw-sentence">
            <span>Real poetry is like</span>
            <span>creating</span>
            <div class="rw-words rw-words-1">
                <span>breathtaking moments</span>
                <span>lovely sounds</span>
                <span>incredible magic</span>
                <span>unseen experiences</span>
                <span>happy feelings</span>
                <span>beautiful butterflies</span>
            </div>
            <br />
            <span>with a silent touch of</span>
            <div class="rw-words rw-words-2">
                <span>sugar</span>
                <span>spice</span>
                <span>colors</span>
                <span>happiness</span>
                <span>wonder</span>
                <span>happiness</span>
            </div>
        </h2>
    </section>
    <br>example 2 <br>
   <!-- Content Wrapper. Contains page content -->
        <div class="ms-header__title main-active">
          <div class="banner">
            <h2> This is</h2>
            <span></span>
          </div>
          <div class="ms-slider">
            <ul class="ms-slider__words">
              <li class="ms-slider__word">Provide the back story, including date of founding, and who was involved </li>
              <li class="ms-slider__word">easy</li>
              <li class="ms-slider__word">powerful</li>
              <li class="ms-slider__word">simple</li>
            </ul>
          </div>
        </div>
        <br>example 3<br>
Vivamus sagittis lacus vel augue laoreet rutrum <span id="rotate_word">faucibus</span> dolor auctor.
<br>example 4<br>
<div id="target">happy</div>
example 5
<p id="nice"> this is <span id="strong">strong</span></p>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
        
    <script>
// example 3
// example 3
// example 3

        /*
        * The reason we do the following twice is because setInterval won't
        * initially call the changeWord function until 3 seconds has passed,
        * by doing it once first we make sure that we are changing the word
        * as soon as it starts.
        */
        var words = ["Fringilla", "Vulputate", "Ligula", "faucibus"];
        var count = 0;

        changeWord(); // Call the changeWord function
        setInterval(changeWord, 3000); // Call it every 3 seconds

        function changeWord() {

            // Define the word to create
            var current_word = words[count];
            console.log(current_word);

            // Change the word in the HTML
            // $("#rotate_word").html(current_word);
            $('#rotate_word').each(function () {
                $(this).fadeOut('fast', function () {
                    $(this).html(current_word).fadeIn();
                });
            });

            // Get the next word index in the array
            count++;

            // If we've reached the end of the word list, go back to the start
            if (count == words.length) { count = 0; }
        }
// example 4
// example 4
// example 4

        var words = ['Fringilla', 'Vulputate', 'Ligula', 'faucibus'];
        var current = 0;
        var element = $('#target');
        setInterval(function () {
            current = (current==words.length) ? 0 : current;
            element.html(words[current]);
            current += 1;
        }, 3000);
        console.log();

// example 5
// example 5
// example 5

        var list = ['Fringilla', 'Vulputate', 'Ligula', 'faucibus'];
        var o = 0;

        setInterval(function () {
            var w = list[o];
            $('#strong').each(function () {
                $(this).fadeOut('fast', function () {
                    $(this).html(w).fadeIn();
                });
            });
            o++;
            if(o == list.length){ o=0; }
        }, 3000);


    </script>

</body>
</html>