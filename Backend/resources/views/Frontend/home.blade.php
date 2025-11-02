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

    .white_text {
      color: rgb(255);
    }

    .burgundy_text {
      color: rgb(148, 74, 74, 100)
    }

    .logo img {
      width: 250px;
    }
    
    #main-header {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      background-color: rgba(49, 14, 14, 100);
    }

    body {
      background-color: rgba(76, 32, 32, 1); 
      margin: 0;
      padding: 0;
    }

    nav {
      display: flex;
      flex-wrap:wrap;
      flex-direction: row;
      flex: 1;
      justify-content: right;
      align-items: center;
    }

    nav a {
      padding: 0px;
      text-decoration: none;
      color: white;
    }

    .icon img {
      width: 75px;
    }

    .icon:hover {
      background: rgba(255, 255, 255, 1);
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
<header id="main-header">
    <div class="logo">
      <a href="home"><img src="Images\darker_logo.png" alt="LOGIQ Logo"></a>
    </div>
    
    <nav>
      <a class="icon" href="search"><img src="Images\search_icon.png" alt="search"></a>
      <a class="icon" href="login"><img src="Images\login_icon.png" alt="login"></a>
      <a class="icon" href="favourites"><img src="Images\favourites_icon.png" alt="favourites"></a>
      <a class="icon" href="basket"><img src="Images\basket_icon.png" alt="basket"></a>
    </nav>
</header>

<main>
  <div class="search-container">
    <input type="text" placeholder="Search..." name="search">
    <button type="submit"><img src="Images\search_icon.png" alt="search"></button>
  </div>

<h1>Explore our Categories!</h1>

<section id="category_images">
  <div class="text_with_image">
    <a href="Twist_Puzzle"><img src="Images\twist_puzzles.png" alt="Twist Puzzles"></a>
    <h3>Twist Puzzle</h3>
  </div>
  
  <div class="text_with_image">
    <a href="Jigsaws"><img src= "Images\jigsaws.png" alt="Jigsaws"></a>
    <h3>Jigsaws</h3>  
  </div>

  <div class="text_with_image">
    <a href="Word_and_Number"><img src= "Images\word_and_number.png" alt="Word and Number"></a>
    <h3>Word and Number</h3>
  </div>

  <div class="text_with_image">
    <a href="Board_Games"><img src= "Images\board_games.png" alt="Board Games"></a>
    <h3>Board Games</h3>
  </div>

  <div class="text_with_image">
    <a href="Handheld_Brain_Teasers"><img src= "Images\handheld_brainTeasers.png" alt="Handheld Brain Teasers"></a>
    <h3>Handheld brain teasers</h3>
  </div>
</section>

</main>
 <footer>
 </footer>
</body>
</html> 