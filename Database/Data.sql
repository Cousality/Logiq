SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO products (productName, productSlug, productCategory, productDifficulty, productPrice, productDescription, productImage, productQuantity, productStatus) VALUES
    ('3x3 Rubik''s Cube', '3x3-rubiks-cube', 'Twist', 'medium', 7.99, 'A classic puzzling favourite with smooth turns and durable construction. The staple for every puzzle collection and a must-have for anyone who enjoys developing technique.', '/Images/3x3_rubiks_cube.png', 5, 'active'),
    ('2x2 Rubik''s Cube', '2x2-rubiks-cube', 'Twist','easy', 6.50, 'Compact, fast and easy to pick up. Perfect for building skills or enjoying quick, casual solves.', '/Images/2x2_rubiks_cube.png', 5, 'active'),
    ('5x5 Rubik''s Cube', '5x5-rubiks-cube', 'Twist','hard', 9.99, 'A step up in difficulty offering deeper strategy and more layers to master, compared to smaller cubes. Perfect for hobbyists ready for a more advanced challenge.', '/Images/5x5_rubiks_cube.png', 5, 'active'),
    ('Pyraminx', 'pyraminx', 'Twist','medium', 5.99, 'A pyramid-shaped puzzle that is unique with fast, intuitive moves. Great for solvers who like something that breaks the standard cube mold.', '/Images/pyraminx.png', 5, 'active'),
    ('Speedcube', 'speedcube', 'Twist','medium', 7.99, 'Built for serious solvers chasing personal bests. It has quick, stable turning and an anti-pop design.', '/Images/speedcube.png', 5, 'active'),

    ('1000 Piece Eiffel Tower Jigsaw Puzzle', 'eiffel-tower-jigsaw', 'Jigsaw', 'hard', 9.99, 'A detailed scene of the Eiffel Tower. This 1000 piece jigsaw is perfect for experienced puzzle fans or for an enjoyable group activity. ', '/Images/eiffel_tower.png', 5, 'active'),
    ('500 Piece London Eye Jigsaw Puzzle', 'london-eye-jigsaw', 'Jigsaw','medium', 7.99, 'A scenic London Eye view that offers a satisfying mid-level challenge, while also balancing relaxation.', '/Images/london_eye.png', 5, 'active'),
    ('500 Piece Big Ben Jigsaw Puzzle', 'big-ben-jigsaw', 'Jigsaw','medium', 8.99, 'A classic image of Big Ben surrounded by the city atmosphere. The colours make the puzzle engaging without being overwhelming. ', '/Images/big_ben.png', 5, 'active'),
    ('100 Piece Statue of Liberty Puzzle', 'statue-of-liberty-jigsaw', 'Jigsaw','easy', 5.99, 'A beginner-friendly puzzle showing the Statue of Liberty and its colourful surroundings.', '/Images/statueLiberty.png', 5, 'active'),
    ('100 Piece Sphinx and Pyramid Jigsaw', 'sphinx-pyramid-jigsaw', 'Jigsaw','easy', 5.99, 'Features Egypt''s iconic ancient landmarks in a warm desert setting. This 100 piece puzzle is perfect for new puzzlers because of its straightforward shapes and colours.', '/Images/sphinx_pyramid.png', 5, 'active'),

    ('100 Sudoku Puzzles', 'sudoku-word-number', 'Word&Number', 'hard', 9.99, 'A puzzle book containing a collection of challenging Sudoku grids designed to help expand problem-solving skills.', '/Images/sudoku.png', 5, 'active'),
    ('40 Crossword Puzzles', 'crossword-word-number', 'Word&Number','medium', 7.50, 'A book of classic crossword challenged covering a range of themes and vocabulary.', '/Images/crossword.png', 5, 'active'),
    ('Scrabble', 'scrabble-word-number', 'Word&Number','medium', 8.50, 'A classic competitive word-building board game focused on strategy, vocabulary and smarter tile placement.', '/Images/scrabble.png', 5, 'active'),
    ('20 Word Search Puzzles', 'word-search-word-number', 'Word&Number','easy', 5.99, 'A compact set of themed word searches that are designed for quick, relaxed puzzle sessions.', '/Images/word_search.png', 5, 'active'),
    ('80 Nonogram Puzzles', 'nonogram-word-number', 'Word&Number','medium', 8.99, 'A grid-based logic puzzle perfect for anyone who enjoys visual logic challenges and a steady problem-solving puzzle experience.', '/Images/nonogram.png', 5, 'active'),

    ('Cluedo Board Game', 'cluedo-board-game', 'BoardGames', 'medium', 7.50, 'A group detective game, a perfect way to get together. This is a puzzle that requires observation and smart questioning.', '/Images/cluedo.png', 5, 'active'),
    ('Ludo Board Game', 'ludo-board-game', 'BoardGames', 'easy', 6.00, 'A game based on smart movement decisions. Players must get all their pieces around the board based on dice rolls, aiming to reach home first.', '/Images/ludo.png', 5, 'active'),
    ('Monopoly Board Game', 'monopoly-board-game', 'BoardGames','medium', 8.99, 'A property management game where players buy locations and try to push rivals into bankruptcy.', '/Images/monopoly.png', 5, 'active'),
    ('Chess Board Game', 'chess-board-game', 'BoardGames','hard', 6.99, 'A timeless two-player strategy game centred on planning, tactics and outthinking your opponent.', '/Images/chess.png', 5, 'active'),
    ('Checkers Board Game', 'checkers-board-game', 'BoardGames','hard', 7.99, 'A simple, tactical board game where players jump and capture pieces to dominate the board.', '/Images/checkers.png', 5, 'active'),

    ('Wooden Burr Puzzle', 'wooden-burr-puzzle', 'BrainTeasers', 'hard', 8.99, 'A wooden 3D interlocking puzzle that challenges players to assemble the pieces in the right order.', '/Images/burr_puzzle.png', 5, 'active'),
    ('Soma Cube', 'soma-cube', 'BrainTeasers','medium', 4.99, 'A seven-piece puzzle that can be built into a cube and many other geometric shapes.', '/Images/soma_cube.png', 5, 'active'),
    ('Snake Twist Puzzle', 'snake-twist-puzzle', 'BrainTeasers','easy', 3.99, 'A flexible linked puzzle that twists and folds into different models and 3D shapes.', '/Images/snake_twist.png', 5, 'active'),
    ('Labyrinth Ball Maze', 'labyrinth-ball-maze', 'BrainTeasers','medium', 5.99, 'A handheld maze where players carefully guide a small ball through ramps and obstacles with steady control.', '/Images/labyrinth_ballMaze.png', 5, 'active'),
    ('Metal Separation Puzzle', 'metal-separation-puzzle', 'BrainTeasers','hard', 6.99, 'A challenging mental brain teaser requiring logic and careful movement to separate intertwined pieces.', '/Images/metal_disentanglement.png', 5, 'active');

-- ============================================================
-- SAMPLE USERS (password = "password")
-- ============================================================
INSERT INTO users (firstName, lastName, email, password, admin) VALUES
    ('Admin', 'User',  'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE),
    ('John',  'Smith',    'john.smith@example.com',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE),
    ('Sarah', 'Jones',    'sarah.jones@example.com',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE),
    ('Mike',  'Brown',    'mike.brown@example.com',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE),
    ('Emma',  'Wilson',   'emma.wilson@example.com',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE),
    ('James', 'Taylor',   'james.taylor@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE),
    ('Lucy',  'Anderson', 'lucy.anderson@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', FALSE);

-- ============================================================
-- REVIEWS
-- userID 1=John Smith, 2=Sarah Jones, 3=Mike Brown,
--        4=Emma Wilson,  5=James Taylor, 6=Lucy Anderson
-- productID order matches product INSERT above (1-25)
-- ============================================================
INSERT INTO reviews (userID, productID, rating, reviewComment) VALUES
    -- 3x3 Rubik's Cube (productID 1)
    (1, 1, 5.0, 'Absolutely love this cube. Smooth turns and great build quality — well worth it.'),
    (2, 1, 4.5, 'Really solid cube for the price. Turns are fast and responsive.'),
    (3, 1, 4.0, 'Great classic puzzle. Took me a while to learn but very satisfying once solved.'),
    (4, 1, 5.0, 'Perfect for beginners and experienced solvers alike. My go-to recommendation.'),
    (5, 1, 3.5, 'Good cube but it started popping pieces slightly after heavy use.'),

    -- 2x2 Rubik's Cube (productID 2)
    (1, 2, 4.5, 'Perfect little cube for on-the-go solving. Sturdy and well-made.'),
    (2, 2, 5.0, 'Really enjoyable for quick sessions. Great starter cube for my kids.'),
    (3, 2, 4.0, 'Solid purchase. Easier than the 3x3 but still a fun challenge.'),

    -- 5x5 Rubik's Cube (productID 3)
    (2, 3, 4.5, 'A proper challenge! Took me a week to get the hang of it. Very satisfying.'),
    (4, 3, 4.0, 'Great step up from the 3x3. Good quality, turns smoothly.'),
    (6, 3, 5.0, 'Hard to put down once you get going. Excellent build and works perfectly.'),

    -- Pyraminx (productID 4)
    (1, 4, 4.5, 'Love the different shape. Feels unique compared to standard cubes.'),
    (3, 4, 4.0, 'Looks great, solves quickly. A nice change from the usual cube format.'),
    (5, 4, 3.5, 'Fun puzzle but I expected it to be a bit more durable.'),

    -- Speedcube (productID 5)
    (2, 5, 5.0, 'Incredible for speed-solving. The anti-pop design is a game changer.'),
    (4, 5, 4.5, 'Noticeably faster than a regular 3x3. Highly recommend for anyone getting serious.'),
    (6, 5, 5.0, 'Best cube I have ever owned. Smooth, fast and very well built.'),

    -- 1000 Piece Eiffel Tower Jigsaw (productID 6)
    (1, 6, 4.5, 'Stunning image and great piece quality. Took a few evenings but thoroughly enjoyed it.'),
    (3, 6, 4.0, 'Good challenge for the whole family. The detail in the image is beautiful.'),
    (5, 6, 3.5, 'Nice puzzle but a few pieces were slightly warped. Still enjoyable overall.'),

    -- 500 Piece London Eye Jigsaw (productID 7)
    (2, 7, 5.0, 'Perfect size for a relaxing afternoon puzzle. Lovely image of London.'),
    (4, 7, 4.5, 'Really enjoyed this. Pieces fit together well and it was the right difficulty level.'),
    (6, 7, 4.0, 'Nice quality puzzle. The edge pieces were easy to find which made it less frustrating.'),

    -- 500 Piece Big Ben Jigsaw (productID 8)
    (1, 8, 4.0, 'Lovely puzzle. The sky section was tricky but the finished piece looks great framed.'),
    (3, 8, 4.5, 'Great quality and a satisfying challenge. Image is vibrant and clear.'),

    -- 100 Piece Statue of Liberty Jigsaw (productID 9)
    (2, 9, 5.0, 'Perfect for my young daughter. She loved it and it kept her busy for a good while.'),
    (5, 9, 4.5, 'Really good beginner puzzle. Nice image and pieces are a solid size. Great value.'),
    (6, 9, 4.0, 'Simple but fun. Good for doing with younger children.'),

    -- 100 Piece Sphinx and Pyramid Jigsaw (productID 10)
    (1, 10, 4.5, 'Lovely warm colours make this an easy and pleasant puzzle to complete.'),
    (4, 10, 5.0, 'Great intro puzzle for my nephew. He was so proud when he finished it!'),

    -- 100 Sudoku Puzzles (productID 11)
    (2, 11, 4.0, 'Genuinely challenging. Even the early ones made me think properly. Great value book.'),
    (3, 11, 4.5, 'Keeps my mind sharp on commutes. Excellent variety of difficulty within the collection.'),
    (5, 11, 3.5, 'Some puzzles felt repetitive but overall a solid book for sudoku fans.'),

    -- 40 Crossword Puzzles (productID 12)
    (1, 12, 4.5, 'Brilliant crosswords. Lovely range of topics and just the right level of difficulty.'),
    (6, 12, 4.0, 'Very enjoyable. I do one or two a night before bed. Great quality book.'),

    -- Scrabble (productID 13)
    (2, 13, 5.0, 'Classic family game. We play it every week. Fantastic quality board and tiles.'),
    (4, 13, 4.5, 'Always a crowd pleaser. Good quality edition, nothing loose or flimsy.'),
    (3, 13, 4.0, 'Solid Scrabble set. Bag for tiles is well made. Great for family nights.'),

    -- 20 Word Search Puzzles (productID 14)
    (1, 14, 4.0, 'Nice relaxing word searches. Good for winding down. Compact size is handy.'),
    (5, 14, 3.5, 'Decent word searches but I got through them quite quickly. Could do with more.'),

    -- 80 Nonogram Puzzles (productID 15)
    (2, 15, 4.5, 'Love nonograms and this book has a great mix of sizes. Addictive once you start.'),
    (6, 15, 5.0, 'Absolutely brilliant. Nonograms are my favourite puzzle and this book is excellent value.'),
    (4, 15, 4.0, 'Good intro if you have never tried nonograms. Clear instructions and enjoyable puzzles.'),

    -- Cluedo Board Game (productID 16)
    (1, 16, 4.5, 'Perfect for game nights. Everyone loves Cluedo and this edition is great quality.'),
    (3, 16, 4.0, 'Fun game for groups. Cards and board are good quality. Highly recommended.'),
    (5, 16, 5.0, 'Best group game we own. Always causes arguments and laughter — brilliant fun.'),

    -- Ludo Board Game (productID 17)
    (2, 17, 4.0, 'Simple and fun. The kids absolutely love it. Good solid board.'),
    (6, 17, 4.5, 'Brings back so many memories. Great quality edition and easy to set up and play.'),

    -- Monopoly Board Game (productID 18)
    (1, 18, 4.0, 'Good solid Monopoly set. Board feels sturdy and the money doesn''t feel flimsy.'),
    (4, 18, 4.5, 'Classic game that never gets old. This edition is well made and looks smart.'),
    (3, 18, 3.5, 'Fun game but games do go on a long time. Good quality though.'),

    -- Chess Board Game (productID 19)
    (2, 19, 5.0, 'Beautiful chess set. Pieces are weighty and the board folds flat for storage. Love it.'),
    (5, 19, 4.5, 'Great quality for the price. Perfect for both casual and more serious games.'),
    (6, 19, 4.0, 'Solid chess set. Pieces are clearly distinguishable and feel good in the hand.'),

    -- Checkers Board Game (productID 20)
    (1, 20, 4.0, 'Good classic game. Pieces are solid and the board is a nice size.'),
    (3, 20, 3.5, 'Fun but fairly quick games. Good quality set overall.'),

    -- Wooden Burr Puzzle (productID 21)
    (2, 21, 5.0, 'Absolutely loves this puzzle. Took ages to figure out but so satisfying when done.'),
    (4, 21, 4.5, 'Beautiful wooden quality. Challenging and rewarding. Great gift idea.'),
    (6, 21, 4.0, 'Makes you think hard. Nice quality wood and fits together tightly.'),

    -- Soma Cube (productID 22)
    (1, 22, 4.0, 'Interesting little puzzle. More shapes than I expected to make. Good value.'),
    (5, 22, 4.5, 'Really enjoyable. The pieces are smooth and well finished. Great desk toy.'),

    -- Snake Twist Puzzle (productID 23)
    (2, 23, 4.0, 'Fun fidget toy and puzzle combined. Kids love it too. Good quality plastic.'),
    (3, 23, 3.5, 'Interesting puzzle but I solved the main shape pretty quickly.'),
    (6, 23, 4.5, 'Great stocking filler. Keeps my hands busy and is surprisingly addictive.'),

    -- Labyrinth Ball Maze (productID 24)
    (1, 24, 4.5, 'Genuinely tricky! Requires real steady hands. Good quality construction.'),
    (4, 24, 4.0, 'Fun and frustrating in equal measure. Exactly what a good puzzle should be.'),
    (5, 24, 5.0, 'I love this thing. So simple but incredibly addictive. Well made and sturdy.'),

    -- Metal Disentanglement Puzzle (productID 25)
    (2, 25, 4.5, 'Deceptively hard. I spent an embarrassing amount of time on this. Excellent puzzle.'),
    (3, 25, 4.0, 'Good quality metal. Takes proper logical thinking and patience. Very satisfying.'),
    (6, 25, 5.0, 'One of the best brain teasers I have tried. Looks simple, absolutely is not.');

-- ============================================================
-- ADDRESSES
-- One default address per user (userID 1–7)
-- addressID 1=Admin User, 2=John Smith, 3=Sarah Jones,
--           4=Mike Brown, 5=Emma Wilson, 6=James Taylor, 7=Lucy Anderson
-- ============================================================
INSERT INTO addresses (userID, recipientFirstName, recipientLastName, phone, addressLine1, addressLine2, city, postCode, isDefault) VALUES
    (1, 'Admin', 'User',     '07700900000', '1 Puzzle Lane',      'Suite 10',    'London',     'EC1A 1BB', TRUE),
    (2, 'John',  'Smith',    '07700900001', '12 Baker Street',    NULL,          'London',     'NW1 6XE', TRUE),
    (3, 'Sarah', 'Jones',    '07700900002', '5 Victoria Road',    'Flat 3',      'Manchester', 'M1 2AB',  TRUE),
    (4, 'Mike',  'Brown',    '07700900003', '8 Castle Terrace',   NULL,          'Edinburgh',  'EH1 2DP', TRUE),
    (5, 'Emma',  'Wilson',   '07700900004', '22 Queen Street',    'Apartment 1', 'Bristol',    'BS1 4NT', TRUE),
    (6, 'James', 'Taylor',   '07700900005', '3 Park Lane',        NULL,          'Birmingham', 'B1 1BB',  TRUE),
    (7, 'Lucy',  'Anderson', '07700900006', '17 Harbour View',    'Floor 2',     'Liverpool',  'L1 8JQ',  TRUE);

-- ============================================================
-- ORDERS
-- orderStatus options: cart | pending | processing | shipped | delivered | cancelled | returned
-- userID 2=John Smith,  3=Sarah Jones,  4=Mike Brown,
--        5=Emma Wilson, 6=James Taylor, 7=Lucy Anderson
-- addressID 1=Admin User, 2=John Smith, 3=Sarah Jones,
--           4=Mike Brown, 5=Emma Wilson, 6=James Taylor, 7=Lucy Anderson
-- ============================================================
INSERT INTO orders (userID, orderDate, orderStatus, totalAmount, addressID) VALUES
    -- Admin User: ten orders covering all statuses
    (1, '2025-11-20 09:15:00', 'delivered',   26.48, 1),  -- orderID 1
    (1, '2025-12-05 14:30:00', 'delivered',   22.97, 1),  -- orderID 2
    (1, '2025-12-22 11:00:00', 'returned',    17.98, 1),  -- orderID 3
    (1, '2026-01-08 16:45:00', 'cancelled',   15.98, 1),  -- orderID 4
    (1, '2026-01-18 10:20:00', 'delivered',   31.47, 1),  -- orderID 5
    (1, '2026-02-02 08:00:00', 'shipped',     20.98, 1),  -- orderID 6
    (1, '2026-02-14 13:10:00', 'returned',    14.98, 1),  -- orderID 7
    (1, '2026-02-25 17:30:00', 'processing',  23.97, 1),  -- orderID 8
    (1, '2026-03-01 09:50:00', 'pending',     12.98, 1),  -- orderID 9
    (1, '2026-03-05 11:15:00', 'shipped',     19.48, 1),  -- orderID 10

    -- John Smith: two orders
    (2, '2026-01-05 10:23:00', 'delivered',  26.48, 2),  -- orderID 11
    (2, '2026-02-14 14:05:00', 'shipped',    14.98, 2),  -- orderID 12

    -- Sarah Jones: two orders
    (3, '2026-01-12 09:00:00', 'delivered',  23.48, 3),  -- orderID 13
    (3, '2026-02-20 11:30:00', 'processing', 15.97, 3),  -- orderID 14

    -- Mike Brown: two orders
    (4, '2025-12-28 16:45:00', 'delivered',  26.48, 4),  -- orderID 15
    (4, '2026-02-25 08:15:00', 'pending',    14.98, 4),  -- orderID 16

    -- Emma Wilson: two orders
    (5, '2026-01-19 13:55:00', 'delivered',  27.96, 5),  -- orderID 17
    (5, '2026-02-28 17:00:00', 'shipped',    14.49, 5),  -- orderID 18

    -- James Taylor: two orders
    (6, '2025-12-15 12:00:00', 'delivered',  19.97, 6),  -- orderID 19
    (6, '2026-01-30 10:10:00', 'cancelled',  15.99, 6),  -- orderID 20

    -- Lucy Anderson: two orders
    (7, '2026-01-08 15:20:00', 'delivered',  25.97, 7),  -- orderID 21
    (7, '2026-02-22 09:45:00', 'processing', 11.98, 7);  -- orderID 22

-- ============================================================
-- ORDER ITEMS
-- priceAtTime reflects the product price at time of purchase
-- ============================================================
INSERT INTO order_items (orderID, productID, quantity, priceAtTime) VALUES
    -- Order 1: Admin (delivered) — 3x3 Rubik's Cube, Eiffel Tower Jigsaw, Scrabble
    (1,  1, 1,  7.99),
    (1,  6, 1,  9.99),
    (1, 13, 1,  8.50),

    -- Order 2: Admin (delivered) — Pyraminx, Speedcube, Soma Cube
    (2,  4, 1,  5.99),
    (2,  5, 1,  7.99),
    (2, 22, 1,  8.99),

    -- Order 3: Admin (returned) — Big Ben Jigsaw, 80 Nonogram Puzzles
    (3,  8, 1,  8.99),
    (3, 15, 1,  8.99),

    -- Order 4: Admin (cancelled) — 100 Sudoku Puzzles, Ludo
    (4, 11, 1,  9.99),
    (4, 17, 1,  5.99),

    -- Order 5: Admin (delivered) — 5x5 Rubik's Cube, Chess, Wooden Burr Puzzle
    (5,  3, 1,  9.99),
    (5, 19, 1, 12.49),
    (5, 21, 1,  8.99),

    -- Order 6: Admin (shipped) — Monopoly, London Eye Jigsaw, Labyrinth Ball Maze
    (6, 18, 1,  8.99),
    (6,  7, 1,  5.99),
    (6, 24, 1,  6.00),

    -- Order 7: Admin (returned) — 2x2 Rubik's Cube, Metal Separation Puzzle
    (7,  2, 1,  7.99),
    (7, 25, 1,  6.99),

    -- Order 8: Admin (processing) — Cluedo, 40 Crossword Puzzles, Checkers
    (8, 16, 1,  7.50),
    (8, 12, 1,  7.48),
    (8, 20, 1,  8.99),

    -- Order 9: Admin (pending) — Snake Twist Puzzle, Sphinx & Pyramid Jigsaw
    (9, 23, 1,  6.99),
    (9, 10, 1,  5.99),

    -- Order 10: Admin (shipped) — Statue of Liberty Jigsaw, Scrabble, 20 Word Search Puzzles
    (10,  9, 1,  5.99),
    (10, 13, 1,  7.50),
    (10, 14, 1,  5.99),

    -- Order 11: John Smith (delivered) — 3x3 Rubik's Cube, Eiffel Tower Jigsaw, Scrabble
    (11,  1, 1,  7.99),
    (11,  6, 1,  9.99),
    (11, 13, 1,  8.50),

    -- Order 12: John Smith (shipped) — 100 Sudoku Puzzles, Soma Cube
    (12, 11, 1,  9.99),
    (12, 22, 1,  4.99),

    -- Order 13: Sarah Jones (delivered) — 2x2 Rubik's Cube, Speedcube, 80 Nonogram Puzzles
    (13,  2, 1,  6.50),
    (13,  5, 1,  7.99),
    (13, 15, 1,  8.99),

    -- Order 14: Sarah Jones (processing) — 500 Piece London Eye Jigsaw, Snake Twist Puzzle x2
    (14,  7, 1,  7.99),
    (14, 23, 2,  3.99),

    -- Order 15: Mike Brown (delivered) — 5x5 Rubik's Cube, Cluedo, Wooden Burr Puzzle
    (15,  3, 1,  9.99),
    (15, 16, 1,  7.50),
    (15, 21, 1,  8.99),

    -- Order 16: Mike Brown (pending) — Monopoly, Labyrinth Ball Maze
    (16, 18, 1,  8.99),
    (16, 24, 1,  5.99),

    -- Order 17: Emma Wilson (delivered) — Pyraminx, Big Ben Jigsaw, Chess, 20 Word Search Puzzles
    (17,  4, 1,  5.99),
    (17,  8, 1,  8.99),
    (17, 19, 1,  6.99),
    (17, 14, 1,  5.99),

    -- Order 18: Emma Wilson (shipped) — 40 Crossword Puzzles, Metal Separation Puzzle
    (18, 12, 1,  7.50),
    (18, 25, 1,  6.99),

    -- Order 19: James Taylor (delivered) — Statue of Liberty Jigsaw, Sphinx & Pyramid Jigsaw, Checkers
    (19,  9, 1,  5.99),
    (19, 10, 1,  5.99),
    (19, 20, 1,  7.99),

    -- Order 20: James Taylor (cancelled) — Ludo, 1000 Piece Eiffel Tower Jigsaw
    (20, 17, 1,  6.00),
    (20,  6, 1,  9.99),

    -- Order 21: Lucy Anderson (delivered) — Speedcube, 80 Nonogram Puzzles, Wooden Burr Puzzle
    (21,  5, 1,  7.99),
    (21, 15, 1,  8.99),
    (21, 21, 1,  8.99),

    -- Order 22: Lucy Anderson (processing) — 3x3 Rubik's Cube, Snake Twist Puzzle
    (22,  1, 1,  7.99),
    (22, 23, 1,  3.99);

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO promotions (promotionCode,discountType,discountValue) VALUES 
    ('WELCOME10','percentage',10.00);
