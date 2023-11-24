-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 24, 2023 lúc 01:29 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `damsmsdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonthuoc`
--

CREATE TABLE `chitietdonthuoc` (
  `id_donthuoc` int(11) NOT NULL,
  `medicine_id` varchar(255) DEFAULT NULL,
  `dongia` decimal(10,2) NOT NULL,
  `soluong` int(11) NOT NULL,
  `thanhtien` decimal(10,2) NOT NULL,
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonthuoc`
--

INSERT INTO `chitietdonthuoc` (`id_donthuoc`, `medicine_id`, `dongia`, `soluong`, `thanhtien`, `create_time`) VALUES
(1, '1', 10.00, 10000, 100000.00, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donthuoc`
--

CREATE TABLE `donthuoc` (
  `id_donthuoc` int(11) NOT NULL COMMENT 'Primary Key',
  `hosobenhan_id` int(11) DEFAULT NULL,
  `tenkhachhang` varchar(255) DEFAULT NULL,
  `tendonthuoc` varchar(255) DEFAULT NULL,
  `ghichu` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donthuoc`
--

INSERT INTO `donthuoc` (`id_donthuoc`, `hosobenhan_id`, `tenkhachhang`, `tendonthuoc`, `ghichu`, `create_time`) VALUES
(1, 1, 'An Duyên ', 'Giảm Đau', 'Liều Nhẹ', NULL),
(2, 2, 'Nguyễn Văn Nam ', 'Giảm Đau', 'Liều Nặng', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hosobenhan`
--

CREATE TABLE `hosobenhan` (
  `id` int(11) NOT NULL,
  `appoiment_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `specialization_id` int(3) DEFAULT NULL,
  `hoten` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(200) DEFAULT NULL,
  `diachi` varchar(200) DEFAULT NULL,
  `ngaykham` date DEFAULT NULL,
  `chandoan` varchar(200) DEFAULT NULL,
  `phuongphapdieutri` varchar(200) DEFAULT NULL,
  `ketquadieutri` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hosobenhan`
--

INSERT INTO `hosobenhan` (`id`, `appoiment_id`, `doctor_id`, `specialization_id`, `hoten`, `ngaysinh`, `gioitinh`, `diachi`, `ngaykham`, `chandoan`, `phuongphapdieutri`, `ketquadieutri`) VALUES
(1, 10, NULL, NULL, 'An Duyên', '2004-09-01', 'Nữ', '12 Nguyễn Văn Bảo', NULL, 'Trật cổ tay', 'Tránh cử động nhiều', 'Trật cổ tay mức độ nhẹ'),
(2, 3, 1, 1, 'Nguyễn Văn Nam', NULL, 'Nam', '12 Nguyen Van Bao P4', NULL, 'DD', '3121', '1312'),
(3, 9, 1, 1, 'Phạm Văn Mạnh', NULL, 'Nam', '12 Nguyen Van Bao P4', NULL, 'qưeq', 'qưe', 'qeqwe'),
(4, 13, 1, 1, 'Phạm Văn Mạnh', NULL, 'Nam', '12 Nguyen Van Bao P4', '2023-11-25', '12', '12', '12'),
(6, 14, 1, NULL, 'Phạm Văn Mạnh', NULL, '', '', '2023-11-17', 'DD', 'qeqw', 'ads');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `hosobenhan_id` int(11) DEFAULT NULL,
  `appoiment_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT 'trang thai',
  `remark` varchar(255) DEFAULT NULL COMMENT 'hinhthuc',
  `invoice_date` date DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `hosobenhan_id`, `appoiment_id`, `name`, `status`, `remark`, `invoice_date`, `amount`) VALUES
(2, 1, 10, 'An Duyên ', 'Chưa Thanh Toán', NULL, NULL, NULL),
(3, 1, 10, 'An Duyên ', 'Chưa Thanh Toán', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_id` int(11) NOT NULL,
  `hosobenhan_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitprice` double NOT NULL,
  `total_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_id`, `hosobenhan_id`, `medicine_id`, `quantity`, `unitprice`, `total_amount`) VALUES
(1, 1, 3, 20, 10, 200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `create_time`, `Email`, `Password`) VALUES
(1, NULL, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblappointment`
--

CREATE TABLE `tblappointment` (
  `appoiment_id` int(10) NOT NULL,
  `AppointmentNumber` int(10) DEFAULT NULL,
  `Name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `MobileNumber` bigint(20) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `AppointmentTime` time DEFAULT NULL,
  `Specialization` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Doctor` int(10) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Status` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblappointment`
--

INSERT INTO `tblappointment` (`appoiment_id`, `AppointmentNumber`, `Name`, `MobileNumber`, `Email`, `AppointmentDate`, `AppointmentTime`, `Specialization`, `Doctor`, `Message`, `ApplyDate`, `Remark`, `Status`, `UpdationDate`) VALUES
(1, 141561395, 'Lê Phương Thảo', 989, 'thao@gmail.com', '2022-11-12', '12:41:00', '2', 2, 'Thanks', '2022-11-10 06:11:50', 'Đặt Lịch Thất Bại', 'Cancelled', '2023-11-15 06:44:38'),
(2, 499219152, 'Đoàn Minh Trường', 7977797979, 'mukesh@gmail.com', '2022-11-13', '12:30:00', '2', 2, 'Thanks', '2022-11-10 07:08:58', 'Đặt Lịch Thành Công', 'Approved', '2023-11-15 06:44:02'),
(3, 485109480, 'Nguyễn Văn Nam', 4654564464, 'nam@gmail.com', '2022-11-11', '13:00:00', '1', 1, 'bjnbjh', '2022-11-10 12:08:51', 'Đặt Lịch Thành Công', 'Approved', '2023-11-15 06:44:14'),
(7, 599829368, 'Lê Hiếu', 4563214563, 'hieu@test.com', '2022-11-25', '15:20:00', '2', 2, 'NA', '2022-11-11 01:49:54', 'Đặt Lịch Thất Bại', 'Cancelled', '2023-11-15 06:44:38'),
(8, 940019123, 'Dương Long', 1425362514, 'lonh@test.com', '2022-11-15', '12:30:00', '13', 4, 'NA', '2022-11-11 01:56:17', 'Đặt Lịch Thành Công', 'Approved', '2023-11-15 06:44:14'),
(9, 714711922, 'Phạm Văn Mạnh', 367387132, 'manhc3dth@gmmail.com', '2023-08-10', '18:31:00', '1', 1, '', '2023-08-02 08:32:12', 'Đặt Lịch Thành Công', 'Approved', '2023-11-15 06:44:14'),
(10, 155731303, 'An Duyên', 389950331, 'manhc3dth@gmail.com', '2023-10-20', '20:22:00', '1', 1, '', '2023-10-04 09:22:37', 'Đặt Lịch Thành Công', 'Approved', '2023-11-15 06:44:14'),
(11, 496754712, 'Nguyễn Văn A', 389950331, 'nva@gmail.com', '2023-10-24', '16:20:00', '4', 4, 'Khám da li?u', '2023-10-22 08:21:07', 'Đặt Lịch Thành Công', 'Cancelled', '2023-11-15 06:44:38'),
(12, 536033159, 'Phạm Văn Mạnh', 367387132, '19522121.manh@student.iuh.edu.vn', '2023-10-24', '16:20:00', '4', 4, '', '2023-10-22 08:26:21', 'Đặt Lịch Thất Bại', 'Cancelled', '2023-11-15 06:44:38'),
(13, 226069565, 'Phạm Văn Mạnh', 234, 'manhc3dth@gmail.com', '2023-11-25', '15:58:00', '1', 1, '24324', '2023-11-11 08:56:53', 'Đặt Lịch Thành Công', 'Approved', '2023-11-15 05:07:15'),
(14, 760820086, 'Phạm Văn Mạnh', 389950331, 'manhc3dth@gmmail.com', '2023-11-17', '22:00:00', '1', 1, '?au', '2023-11-15 06:40:05', 'Ok', 'Approved', '2023-11-15 06:40:34'),
(15, 439934314, 'qeqwe', 389950331, 'manhc3dth@gmail.com', '2023-11-19', '22:00:00', '1', 0, 'eqweq', '2023-11-18 15:57:08', NULL, NULL, NULL),
(16, 892980034, 'Phạm !', 389950331, 'erwe@gmail.com', '2023-11-19', '22:00:00', '1', 1, '?er', '2023-11-18 15:59:03', 'ưq', 'Cancelled', '2023-11-21 12:34:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldoctor`
--

CREATE TABLE `tbldoctor` (
  `ID` int(5) NOT NULL,
  `FullName` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Specialization` varchar(250) DEFAULT NULL,
  `Password` varchar(259) DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldoctor`
--

INSERT INTO `tbldoctor` (`ID`, `FullName`, `MobileNumber`, `Email`, `Specialization`, `Password`, `qrcode`, `role`, `CreationDate`) VALUES
(1, 'Dr. Phạm Mạnh', 367387132, 'manhc3dth@gmail.com', '1', 'f925916e2754e5e03f75dd58a5733251', '', 1, '2022-11-09 15:01:11'),
(2, 'Dr. Duy Hiếu', 6464654646, 'hieu@gmail.com', '2', '202cb962ac59075b964b07152d234b70', '', 1, '2022-11-09 15:01:59'),
(3, 'Dr. Long', 14253625, 'long123@test.com', '7', 'f925916e2754e5e03f75dd58a5733251', '', 1, '2022-11-11 01:28:44'),
(4, 'Dr. Trọng Hiếu', 1231231230, 'hieu123@test.com', '4', 'f925916e2754e5e03f75dd58a5733251', '', 1, '2022-11-11 01:54:44'),
(5, 'Admin', 1231231230, 'admin@gmail.com', NULL, '	\r\nf925916e2754e5e03f75dd58a5733251', NULL, 0, '2023-11-24 03:03:29'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-11-24 03:03:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmedicalrecord`
--

CREATE TABLE `tblmedicalrecord` (
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmedicine`
--

CREATE TABLE `tblmedicine` (
  `ID` int(200) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Category` varchar(200) DEFAULT NULL,
  `Quantity` int(200) DEFAULT NULL,
  `UnitPrice` int(11) DEFAULT NULL,
  `donvi` varchar(255) NOT NULL,
  `Uses` varchar(200) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tblmedicine`
--

INSERT INTO `tblmedicine` (`ID`, `Name`, `Category`, `Quantity`, `UnitPrice`, `donvi`, `Uses`, `Status`) VALUES
(1, 'Paraxetamol', '2', 100, 10000, 'Vỉ', 'Giảm Đau', 'Còn Hàng'),
(2, 'Paradol', '1', 100, 10000, 'Hộp', 'Đau Đầu', 'Hết Hàng'),
(3, 'MANH', '2', 10, NULL, 'Hộp', 'daubung', 'Còn Hàng'),
(4, 'hewqafwe', '1', 100, NULL, 'Vỉ', 'hgqreheqr', 'Còn Hàng'),
(5, 'sgw', '1', 100, NULL, 'Vỉ', 'sbgefrg', 'Còn Hàng'),
(6, 'Phan Phú Phúc', '2', 10, NULL, 'Hộp', 'hong', 'Hết Hàng'),
(7, 'Phan Phú Phúc', '2', 10, NULL, 'Hộp', 'hong', 'Còn Hàng'),
(8, 'Nhân viên quản lý', '2', 10, NULL, 'Hộp', 'hong', 'Hết Hàng'),
(9, 'manh pro ', '2', 10000, 10000, 'Vỉ', 'hong', 'Còn Hàng'),
(11, 'manh pro ', '2', 10000, 10000, 'Hộp', 'hong', 'Còn Hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PageTitle` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PageDescription` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', '<div><font color=\"#202124\" face=\"arial, sans-serif\"><b>Our mission declares our purpose of existence as a company and our objectives.</b></font></div><div><font color=\"#202124\" face=\"arial, sans-serif\"><b><br></b></font></div><div><font color=\"#202124\" face=\"arial, sans-serif\"><b>To give every customer much more than what he/she asks for in terms of quality, selection, value for money and customer service, by understanding local tastes and preferences and innovating constantly to eventually provide an unmatched experience in jewellery shopping.</b></font></div>', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', '12 Nguyễn Văn Bảo , Phường 4, Gò Vấp, TP Hồ Chí Minh', 'nhom10@gmail.com', 366075089, NULL, '9:30  Sáng - 17:30 Chiều\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblspecialization`
--

CREATE TABLE `tblspecialization` (
  `ID` int(5) NOT NULL,
  `Specialization` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblspecialization`
--

INSERT INTO `tblspecialization` (`ID`, `Specialization`, `CreationDate`) VALUES
(1, 'Khoa Chấn Thương Chỉnh Hình', '2022-11-09 14:22:33'),
(2, 'Khoa Nội', '2022-11-09 14:23:42'),
(3, 'Khoa Phụ Sản', '2022-11-09 14:24:14'),
(4, 'Khoa Da lLễu', '2022-11-09 14:24:42'),
(5, 'Khoa Nhi', '2022-11-09 14:25:06'),
(7, 'Khoa Ngoại', '2022-11-09 14:25:52'),
(8, 'Khoa Mắt', '2022-11-09 14:27:18'),
(13, 'ENT', '2022-11-09 14:30:13');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonthuoc`
--
ALTER TABLE `chitietdonthuoc`
  ADD KEY `id_donthuoc` (`id_donthuoc`);

--
-- Chỉ mục cho bảng `donthuoc`
--
ALTER TABLE `donthuoc`
  ADD PRIMARY KEY (`id_donthuoc`),
  ADD KEY `hosobenhan_id` (`hosobenhan_id`);

--
-- Chỉ mục cho bảng `hosobenhan`
--
ALTER TABLE `hosobenhan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_1` (`appoiment_id`),
  ADD KEY `fk_2` (`doctor_id`),
  ADD KEY `fk_3` (`specialization_id`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Chỉ mục cho bảng `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`invoice_id`) USING BTREE,
  ADD KEY `invoice_details_ibfk_2` (`medicine_id`);

--
-- Chỉ mục cho bảng `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`appoiment_id`);

--
-- Chỉ mục cho bảng `tbldoctor`
--
ALTER TABLE `tbldoctor`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tblmedicine`
--
ALTER TABLE `tblmedicine`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tblspecialization`
--
ALTER TABLE `tblspecialization`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donthuoc`
--
ALTER TABLE `donthuoc`
  MODIFY `id_donthuoc` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `hosobenhan`
--
ALTER TABLE `hosobenhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `appoiment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbldoctor`
--
ALTER TABLE `tbldoctor`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tblmedicine`
--
ALTER TABLE `tblmedicine`
  MODIFY `ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblspecialization`
--
ALTER TABLE `tblspecialization`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonthuoc`
--
ALTER TABLE `chitietdonthuoc`
  ADD CONSTRAINT `chitietdonthuoc_ibfk_1` FOREIGN KEY (`id_donthuoc`) REFERENCES `donthuoc` (`id_donthuoc`);

--
-- Các ràng buộc cho bảng `donthuoc`
--
ALTER TABLE `donthuoc`
  ADD CONSTRAINT `donthuoc_ibfk_1` FOREIGN KEY (`hosobenhan_id`) REFERENCES `hosobenhan` (`id`);

--
-- Các ràng buộc cho bảng `hosobenhan`
--
ALTER TABLE `hosobenhan`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`appoiment_id`) REFERENCES `tblappointment` (`appoiment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`doctor_id`) REFERENCES `tbldoctor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_3` FOREIGN KEY (`specialization_id`) REFERENCES `tblspecialization` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`),
  ADD CONSTRAINT `invoice_details_ibfk_2` FOREIGN KEY (`medicine_id`) REFERENCES `tblmedicine` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_details_ibfk_3` FOREIGN KEY (`hosobenhan_id`) REFERENCES `invoices` (`hosobenhan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
