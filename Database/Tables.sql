CREATE TABLE userid (
    userID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(17),
    password VARCHAR(100) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE products (
    productID  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(100) NOT NULL,
    productCategory VARCHAR(100) NOT NULL,
    productPrice DECIMAL(8, 2) NOT NULL,
    productRating INT(1) CHECK (productRating >= 1 AND productRating <=5)
    productDescription TEXT NOT NULL,
)

CREATE TABLE reviews (
    reviewID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT(11) NOT NULL,
    productID INT(11) NOT NULL,
    rating INT(1) NOT NULL CHECK (rating >= 1 AND rating <= 5),
    reviewTitle VARCHAR(100),
    reviewText TEXT,
    reviewDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES userid(userID) ON DELETE CASCADE,
    FOREIGN KEY (productID) REFERENCES products(productID) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;
