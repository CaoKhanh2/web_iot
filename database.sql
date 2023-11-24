-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 17, 2023 lúc 08:47 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `database`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cardid`
--

CREATE TABLE `cardid` (
  `ID` varchar(255) NOT NULL,
  `ID_NgDung` varchar(25) NOT NULL,
  `Device` varchar(255) NOT NULL,
  `TrangThai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cardid`
--

INSERT INTO `cardid` (`ID`, `ID_NgDung`, `Device`, `TrangThai`) VALUES
('23FC5DA9', 'NV01', '', 1),
('96C6965F', 'CK1', '', 1),
('B385F3A6', 'NV02', '', 1),
('E083B889', 'CN01', '', 1),
('HGD8383', 'CV01', '', 1),
('KL8438', 'CV02', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history`
--

CREATE TABLE `history` (
  `ID` int(255) NOT NULL,
  `ID_Card` varchar(255) NOT NULL,
  `VaoRa` int(1) NOT NULL,
  `ThoiGian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `history`
--

INSERT INTO `history` (`ID`, `ID_Card`, `VaoRa`, `ThoiGian`) VALUES
(1, '96C6965F', 1, '2023-11-17 04:49:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `information`
--

CREATE TABLE `information` (
  `ID` varchar(25) NOT NULL,
  `Hovaten` varchar(50) NOT NULL,
  `GioiTinh` varchar(3) NOT NULL,
  `NgaySinh` date NOT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `information`
--

INSERT INTO `information` (`ID`, `Hovaten`, `GioiTinh`, `NgaySinh`, `Email`) VALUES
('CK1', 'Trần Nam', 'Nam', '1990-11-15', NULL),
('CN01', 'Nguyễn B', 'Nam', '1990-11-19', ''),
('CV01', 'Kiên', 'Nam', '1990-12-12', ''),
('CV02', 'Đinh Picas', 'Nam', '1990-08-08', ''),
('NV01', 'Nguyễn Văn A', 'Nam', '1990-11-08', NULL),
('NV02', 'Lê An', 'Nam', '1990-11-28', ''),
('NV03', 'Kiên', 'Nam', '1990-12-21', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ID` int(25) NOT NULL,
  `TaiKhoan` varchar(30) NOT NULL,
  `MatKhau` varchar(20) NOT NULL,
  `TenNguoiDung` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `TrangThai` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ID`, `TaiKhoan`, `MatKhau`, `TenNguoiDung`, `Email`, `TrangThai`) VALUES
(1, 'admin', '123456', 'Hai', '', b'1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cardid`
--
ALTER TABLE `cardid`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cardid_ibfk_1` (`ID_NgDung`);

--
-- Chỉ mục cho bảng `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `history_ibfk_1` (`ID_Card`);

--
-- Chỉ mục cho bảng `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `history`
--
ALTER TABLE `history`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cardid`
--
ALTER TABLE `cardid`
  ADD CONSTRAINT `cardid_ibfk_1` FOREIGN KEY (`ID_NgDung`) REFERENCES `information` (`ID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`ID_Card`) REFERENCES `cardid` (`ID`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
