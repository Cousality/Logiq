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

<<<<<<< HEAD
    <header class="hero">
        <div class="hero-text">
            <h1>Don't Solve A Problem.<br />Be The Problem.</h1>
            <p>Puzzles go BRR</p>
            <br />
            <a href="{{ route('store.index') }}" class="cta-button">Browse Store</a>
        </div>
        <div class="puzzle-card">
            <div class="puzzle-badge">DAILY LOGIQ #1</div>
            <div class="puzzle-question">Sequence: 2, 4, 6, 8, 10, ?</div>
            <div class="puzzle-options">
                <button onclick="checkAnswer(12)">12</button>
                <button onclick="checkAnswer(14)">14</button>
                <button onclick="checkAnswer(16)">16</button>
            </div>
            <div id="feedback"></div>
        </div>
    </header>
=======
    @include('Frontend.components.navbar')
>>>>>>> main

    <main>
        <h1>Explore our Categories!</h1>

        <section id="category_images">
            <div class="text_with_image">
                <a href="store"><img src="Images\twist_puzzles.png" alt="Twist Puzzles"></a>
                <!--Image Reference: https://unsplash.com/photos/3x3-rubiks-cube-toy-inI8GnmS190 -->
                <h3>Twist Puzzle</h3>
            </div>

            <div class="text_with_image">
                <a href="store"><img src= "Images\jigsaws.png" alt="Jigsaws"></a>
                <!--Image Reference: https://unsplash.com/photos/a-close-up-of-a-puzzle-on-a-table-FliC0KecSw0 -->
                <h3>Jigsaws</h3>
            </div>

            <div class="text_with_image">
                <a href="store"><img src= "Images\word_and_number.png" alt="Word and Number"></a>
                <!--Image Reference: https://unsplash.com/photos/yellow-and-blue-lego-blocks-LI03w3L-PxU -->
                <h3>Word and Number</h3>
            </div>

            <div class="text_with_image">
                <a href="store"><img src= "Images\board_games.png" alt="Board Games"></a>
                <!--Image Reference: https://unsplash.com/photos/a-close-up-of-a-chess-board-with-pieces-on-it-vh-5LuWlZ_4 -->
                <h3>Board Games</h3>
            </div>

            <div class="text_with_image">
                <a href="store"><img src= "Images\handheld_brainTeasers.png" alt="Handheld Brain Teasers"></a>
                <!--Image Reference: https://unsplash.com/photos/a-small-metal-object-sitting-on-top-of-a-table-PFBWQDuWEWs -->
                <h3>Handheld Brain Teasers</h3>
            </div>
        </section>

    </main>

    @include('Frontend.components.footer')

</body>

</html>
