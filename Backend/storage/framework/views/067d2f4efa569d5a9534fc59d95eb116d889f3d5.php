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
    
    #logiqFooter {
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      background-color: rgba(49, 14, 14, 100);
      padding: 20px;
      margin: 0;
    }

    #footerColumns {
      display: flex;
      flex-wrap: wrap;
      flex-direction: row;
      justify-content: flex-start;
      gap: 60px;
    }

    .list {
      display: flex;
      flex-direction: column;
      list-style-type: none;
      color: rgba(255, 255, 255, 100);
      font-size: 20px;
      padding-top: 30px;
      padding-bottom: 30px;
      margin: 0;   
    }

    .footerLinks {
      text-decoration: none;
      color: rgba(255, 255, 255, 100);
    }
    
    #logoCopyright {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      flex-wrap: wrap;
    }
    
    .footerLogo img {
      padding: 0px;
      width: 250px;
    }
    
    #footerCopyright {
      width: 50%;
      background-color: rgba(49, 14, 14, 100);
      color: white; 
      font-size: 80%;
    }

  </style>

</head>
<body>

<?php echo $__env->make('Frontend.components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
 <footer id="logiqFooter">
  <div id="footerColumns">

    <div>
      <ul class="list">
        <li><h4>Quick Links</h4></li>
        <li><a class="footerLinks" href="About_us">About Us</a></li>
        <li><a class="footerLinks" href="Contact">Contact</a></li>
        <li><a class="footerLinks" href="FAQs">FAQs</a><li>
      </ul>
    </div>
    
    <div>
      <ul class="list">
        <li><h4>Policies</h4></li>
        <li><a class="footerLinks" href="privacy_policy">Privacy Policy</a></li>
        <li><a class="footerLinks" href="TermsConditions">Terms & Conditions</a></li>
        <li><a class="footerLinks" href="Return_policy">Return Policy</a></li>
      </ul>
    </div>
  </div>
  
  <section id="logoCopyright">
    <div id="footerCopyright">
      <p>&copy; LogIQ | All Rights Reserved | Secure payments via PayPal, Visa, MasteCard, Apple Pay, Google Pay</p>
    </div>
    
    <div class="footerLogo">
      <a href="/"><img src="Images\darker_logo.png" alt="LOGIQ Logo"></a>
    </div>
  </section>

 </footer>
</body>
</html> <?php /**PATH C:\Users\ianhj\Documents\github\Logiq\Backend\resources\views/Frontend/home.blade.php ENDPATH**/ ?>