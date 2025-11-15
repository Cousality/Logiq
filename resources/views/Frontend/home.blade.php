<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <style>
    h1 {
      font-family: 'inria Serif';
      font-size: 60px;
      color: rgba(255, 255, 255, 100);
      text-align: center;
    }

    h3 {
      font-family: 'inria Serif';
      font-size: 20px;
    }

    h4 {
      color: rgba(255, 255, 255, 100);
      font-size: 25px;
    }

    body {
      background-color: rgba(76, 32, 32, 1); 
      margin: 0;
      padding: 0;
    }

    .search-container input[type=text] {
      float: left;
      padding: 8px;
      margin-top: 20px;
      margin-left: 20px;
      width: 50%;
      font-size: 15px;
    }

    .search-container img {
      width: 40px;
    }

    .search-container button {
      padding: 0px;
      margin-top: 20px;
      margin-left: ;
      background: rgba(76, 32, 32, 1); 
      border: none;
      cursor: pointer;
    }

    #category_images {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .text_with_image {
      text-align: center;
      width: 30%;
      color: white;
    }

    #category_images img {
      width: 55%;  
    } 

  </style>

</head>
<body>

@include('Frontend.components.navbar')

<main>
  <div class="search-container">
    <input type="text" placeholder="Search..." name="search">
    <button type="submit"><img src="Images\search_icon.png" alt="search"></button>
  </div>

<h1>Explore our Categories!</h1>

<section id="category_images">
  <div class="text_with_image">
    <a href="Twist_Puzzle"><img src="Images\twist_puzzles.png" alt="Twist Puzzles"></a>
    <!--Image Reference: https://unsplash.com/photos/3x3-rubiks-cube-toy-inI8GnmS190 -->
    <h3>Twist Puzzle</h3>
  </div>
  
  <div class="text_with_image">
    <a href="Jigsaws"><img src= "Images\jigsaws.png" alt="Jigsaws"></a>
    <!--Image Reference: https://unsplash.com/photos/a-close-up-of-a-puzzle-on-a-table-FliC0KecSw0 -->
    <h3>Jigsaws</h3>  
  </div>

  <div class="text_with_image">
    <a href="Word_and_Number"><img src= "Images\word_and_number.png" alt="Word and Number"></a>
    <!--Image Reference: https://unsplash.com/photos/yellow-and-blue-lego-blocks-LI03w3L-PxU -->
    <h3>Word and Number</h3>
  </div>

  <div class="text_with_image">
    <a href="Board_Games"><img src= "Images\board_games.png" alt="Board Games"></a>
    <!--Image Reference: https://unsplash.com/photos/a-close-up-of-a-chess-board-with-pieces-on-it-vh-5LuWlZ_4 -->
    <h3>Board Games</h3>
  </div>

  <div class="text_with_image">
    <a href="Handheld_Brain_Teasers"><img src= "Images\handheld_brainTeasers.png" alt="Handheld Brain Teasers"></a>
    <!--Image Reference: https://unsplash.com/photos/a-small-metal-object-sitting-on-top-of-a-table-PFBWQDuWEWs -->
    <h3>Handheld Brain Teasers</h3>
  </div>
</section>

</main>

@include('Frontend.components.footer')

</body>
</html> 