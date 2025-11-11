<!DOCTYPE html>
<head>
    <style>
        .content-wrapper {
            display: flex;
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        .sidebar {
            flex: 0 0 200px;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            height: fit-content;
        }       
        .sidebar h2 {
            color: #32174d;
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .filter-option input[type="checkbox"] {
            cursor: pointer;
        }
    </style>
</head>
<body>
@include('Frontend.components.navbar')

 <div class="content-wrapper">
            <aside class="sidebar">
                <h2>Filter by Category</h2>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="Twist">
                        Twist Puzzle
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="Jigsaw">
                        Jigsaws
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="WordandNumber">
                        Word and Number
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="Board">
                        Board Games
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="BrainTeaser">
                        Handheld Brain Teasers
                    </label>
                </div>
                <h2>Filter by Difficulty</h2>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="Twist">
                        Easy
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="Jigsaw">
                        Medium
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="puzzle" value="WordandNumber">
                        Hard
                    </label>
                </div>
            </aside>
    </div>
</body>
@include('Frontend.components.footer')
</html>