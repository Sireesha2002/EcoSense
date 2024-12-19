-- Create the `categories` table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL
);

-- Insert categories into the table
INSERT INTO categories (name, image_path) VALUES
('Cleanser', 'cleanser.png'),
('Exfoliant', 'exfoliant.png'),
('Eye Cream', 'eye_cream.png'),
('Face Mask', 'face_mask.png'),
('Moisturizer', 'moisturizer.png'),
('Serum', 'serum.png'),
('Sunscreen', 'sunscreen.png'),
('Toner', 'toner.png'),
('Treatment', 'treatment.png');
