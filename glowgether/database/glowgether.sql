-- Buat database Glowgether
CREATE DATABASE IF NOT EXISTS glowgether;
USE glowgether;

-- 1. Tabel Kategori
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- 2. Tabel Produk
CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES category(id)
);

-- 3. Tabel Transaksi
CREATE TABLE transaction (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    buyer_name VARCHAR(100),
    qty INT,
    date DATE,
    FOREIGN KEY (product_id) REFERENCES product(id)
);

-- Isi kategori
INSERT INTO category (name) VALUES
('Skincare'),
('Makeup'),
('Health Product');

-- Isi produk K-Beauty + gambar
INSERT INTO product (name, brand, price, description, image_url, category_id) VALUES
('Green Tea Seed Serum', 'Innisfree', 120000, 'Hydrating serum dengan ekstrak green tea Jeju.', 'https://koreanskincare.nl/cdn/shop/files/467013853_18466105798037010_9177982332670859662_n.jpg?v=1738151086', 1),
('Lip Sleeping Mask', 'Laneige', 135000, 'Masker bibir malam hari dengan aroma berry.', 'https://www.laneige.com/id/id/product/__icsFiles/afieldfile/2025/02/26/250226_final_ID_lip-sleeping-mask_pdp_thumbnail_04.jpg', 1),
('Fixing Tint', 'Etude', 85000, 'Lip tint matte tahan lama dan tidak transfer.', 'https://cdn.shopify.com/s/files/1/0620/9224/7178/files/Fixing_Tint_3.jpg?v=1688539258', 2),
('Moistfull Collagen Cream', 'Etude', 110000, 'Pelembap dengan kolagen untuk kulit kenyal dan glowing.', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2022/10/14/c5843987-dda2-4e72-8aed-782442f948fc.jpg', 1),
('Cica Soothing Cream', 'Some By Mi', 98000, 'Krim penenang untuk kulit sensitif dan berjerawat.', 'https://down-id.img.susercontent.com/file/049d74c0cf91884eeae2961c48c1f43d', 1),
('Cushion Foundation SPF50+', 'Clio', 160000, 'Cushion foundation high coverage dan UV protection.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIihUTP97KtNTFwg1sIU5cuphxq6b512nW2g&s', 2),
('Vitamin C Glow Toner', 'Cosrx', 88000, 'Toner pencerah wajah dengan vitamin C murni.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXym9xsmeHvcnT8Got2ESIgkIpTmcpFVU4DQ&s', 1),
('Multivitamin Jelly', 'Lemona', 55000, 'Jelly vitamin rasa lemon yang menyegarkan dan praktis.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSldsSbBDj_RAebmsDiVJfopPdlW4nHFvLdzA&s', 3);

-- Isi transaksi (K-pop Idol as customer)
INSERT INTO transaction (product_id, buyer_name, qty, date) VALUES
(1, 'Seuun', 1, '2025-04-18'),
(2, 'Jungwon', 2, '2025-04-19'),
(3, 'Karina', 1, '2025-04-20'),
(4, 'Carmen', 1, '2025-04-21'),
(5, 'Hanni', 2, '2025-04-22'),
(6, 'ZangHao', 1, '2025-04-22');
