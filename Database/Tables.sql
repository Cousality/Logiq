CREATE TABLE users (
    userID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE addresses (
    addressID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    recipientFirstName VARCHAR(50) NOT NULL,
    recipientLastName VARCHAR(50) NOT NULL,
    phone VARCHAR(20),  
    addressLine1 VARCHAR(255) NOT NULL,
    addressLine2 VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    postCode VARCHAR(20) NOT NULL,
    isDefault BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    INDEX idx_user_address (userID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE products (
    productID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(100) NOT NULL,
    productSlug VARCHAR(120) NOT NULL UNIQUE,
    productCategory ENUM('Twist','Jigsaw','Word&Number','BoardGames','HandheldBrainTeasers') NOT NULL,
    productDifficulty ENUM('easy','medium','hard') NOT NULL,
    productPrice DECIMAL(10, 2) NOT NULL,
    productDescription TEXT NOT NULL,
    productImage VARCHAR(255),
    productQuantity SMALLINT NOT NULL DEFAULT 0,
    productStatus ENUM('active','hidden') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (productCategory),
    INDEX idx_price (productPrice)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE orders (
    orderID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT(11) NOT NULL,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    orderStatus ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') NOT NULL DEFAULT 'pending',
    totalAmount DECIMAL(10, 2) NOT NULL,
    addressID INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (addressID) REFERENCES addresses(addressID) ON DELETE SET NULL,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    INDEX idx_user_order (userID),
    INDEX idx_order_status (orderStatus)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE order_items (
    orderItemID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    orderID INT(11) NOT NULL,
    productID INT(11) NOT NULL,
    quantity INT NOT NULL,
    priceAtTime DECIMAL(8, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (orderID) REFERENCES orders(orderID) ON DELETE CASCADE,
    FOREIGN KEY (productID) REFERENCES products(productID) ON DELETE RESTRICT,
    INDEX idx_order (orderID),
    INDEX idx_product (productID)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE reviews (
    reviewID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT(11) NOT NULL,
    productID INT(11) NOT NULL,
    rating INT(1) NOT NULL CHECK (rating >= 1 AND rating <= 5),
    reviewTitle VARCHAR(100),
    reviewText TEXT,
    reviewDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (productID) REFERENCES products(productID) ON DELETE CASCADE,
    INDEX idx_product_rating (productID, rating),
    INDEX idx_user_review (userID)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE wishlists (
    wishlistID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT(11) NOT NULL,
    productID INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (productID) REFERENCES products(productID) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (userID, productID),
    INDEX idx_user_wishlist (userID),
    INDEX idx_product_wishlist (productID)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE=utf8mb4_general_ci;