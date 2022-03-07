CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `link`, `pos`, `status`) VALUES
(4, '/upload/banner/1622261619.jpg', '#', 4, 1),
(5, '/upload/banner/1622261699.jpg', '#', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `name`, `link`, `icon`, `status`) VALUES
(1, 'Facebook', 'https://www.facebook.com/xoaiuc.order', 'fa-facebook', 1),
(2, 'Youtube', '#', 'fa-youtube', 1),
(3, 'Instagram', '#', 'fa-instagram', 1),
(4, 'Twitter', '#', 'fa-twitter', 1),
(5, 'Pinterest', '#', 'fa-pinterest', 1);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `des` text DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `code`, `image`, `des`, `content`) VALUES
(1, 'logo', '/upload/1622450817.png', '', ''),
(2, 'hotline', NULL, '0399176012', ''),
(3, 'email', NULL, 'kisadlu@gmail.com', 'hollywoodvietnam@gmail.com'),
(4, 'title', NULL, 'Xuất khẩu, sỉ, lẻ Xoài Úc Cam Lâm', ''),
(5, 'addressfooter', NULL, 'Địa chỉ: 132-134 Nguyễn Gia Trí, Phường 25, Quận Bình Thạnh, TP Hồ Chí Minh', ''),
(6, 'Map home', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0814803649805!2d106.71385691526045!3d10.805071361617749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175291c97e5086d%3A0x2fd0616d58390dc4!2zMTMyIMSQLiBOZ3V54buFbiBHaWEgVHLDrSwgUGjGsOG7nW5nIDI1LCBCw6xuaCBUaOG6oW5oLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1618372686297!5m2!1svi!2s\" width=\"100%\" height=\"350\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', ''),
(7, 'copyright', NULL, 'Copyright © 2021 Xoài Úc Cam Lâm. All rights reserved', NULL),
(8, 'banner', '/upload/1622455428.jpg', '', ''),
(9, 'website', NULL, 'http://xoaiuc.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `longtitle` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `slug` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `longtitle`, `image`, `content`, `create_at`, `status`, `slug`) VALUES
(1, 'Xoài Úc ở \'thủ phủ\' Cam Lâm cho thu hàng trăm triệu đồng/ha', 'Với 3.000 ha xoài Úc cho năng suất cao, nhiều hộ gia đình ở Cam Lâm, Khánh Hòa hướng đến sản xuất sạch theo quy trình VietGAP để ổn định xuất khẩu', '/upload/news/blog-img-3.jpg', '<div class=\"title-news pb-4\"><h2>Thủ phủ\' xoài Úc Cam Lâm đã xuất khẩu trở lại</h2></div>\r\n                        <div class=\"blog-content\">\r\n                           <i>Sau thời gian không xuất khẩu được, đặc sản xoài Úc trồng tại huyện Cam Lâm (tỉnh Khánh Hòa) đã được thông quan trở lại. Tuy thị trường ở \"thủ phủ\" xoài này đã ấm lên nhưng giá xoài bán ra vẫn ở mức thấp khiến niềm vui của nhà vườn chưa trọn vẹn.</i>\r\n                           <div class=\"row mt-3 mb-3\">\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-1.jpg\" class=\"responsive\"></div>\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-2.jpg\" class=\"responsive\"></div>\r\n                           </div>\r\n                           <p>Những ngày này, vựa xoài Trường Lan ở huyện Cam Lâm đã tất bật người phân loại, đóng gói, xếp “rổ” xoài để chuẩn bị cho xe container đến chở ra phía Bắc xuất khẩu sang Trung Quốc. Trên những \"rổ\" xoài được đóng gói kỹ càng, bên cạnh dòng chữ nước ngoài thể hiện nguồn gốc xuất xứ của sản phẩm, chủ vựa cũng không quên để thêm dòng tiếng Việt “Úc 1” để chứng minh đây là hàng loại ngon.</p>\r\n                           <p>Ông Trường - chủ vựa xoài Trường Lan cho hay, hiện các cửa khẩu đã mở cửa bình thường nhưng hạn chế số lượng xuất hàng nên xoài vẫn bị ùn ứ. Tình trạng này khiến chi phí tăng vì phải chi trả tiền thuê xe, thuê phòng nghỉ cho tài xế chờ ở cửa khẩu… Tính ra, chi phí cho mỗi \"rổ\" 25 kg xoài mất tới 300.000 đồng để đưa từ vựa đến khi xuất bán sang nước ngoài - cao gấp đôi so với trước đây.</p>\r\n                           <p>Mỗi ngày vựa của ông Trường thu mua khoảng 20 tấn xoài, đủ một container để xuất đi Trung Quốc, tương đương các thời điểm trước khi có dịch COVID-19. Tuy nhiên, dự báo thời gian tới, việc tiêu thụ có thể chậm hơn vì gặp nhiều khó khăn về thủ tục ở cửa khẩu; trong khi xoài lại bắt đầu chín rộ khiến ông Trường vẫn lo lắng.</p>\r\n                           <p>Thời điểm sau Tết Nguyên đán, do dịch COVID-19 hoành hành khiến các cửa khẩu tạm đóng nên thị trường xuất khẩu xoài sang Trung Quốc phải tạm dừng. Thời gian gần đây, sau khi cửa khẩu Việt - Trung thông quan trở lại, việc tiêu thụ xoài của người dân đã thuận lợi hơn. Nhiều vựa thu mua xoài ở Cam Lâm phục vụ thị trường xuất khẩu đã hoạt động trở lại, sức mua đều hơn so với thời điểm 1 - 2 tháng trước đây. Tuy nhiên, hiện giá xoài thu mua chỉ ở mức thấp, dao động từ 15.000 - 20.000 đồng/kg tuỳ loại, trong khi thời điểm này mọi năm có giá từ 30.000 - 40.000 đồng/kg.</p>\r\n                           <p>Ông Diệp Thế Thanh - một hộ dân trồng xoài theo tiêu chuẩn VietGAP ở xã Cam Hải Tây, huyện Cam Lâm cho biết, xoài của ông hiện được thương lái thu mua với giá 19.000 - 20.000 đồng/kg do ông trồng và chăm sóc theo tiêu chuẩn sạch, an toàn nên chất lượng rất đảm bảo. Với mức giá này, thực tế người trồng xoài như ông không có lãi nhưng không đến nỗi phải chịu thua lỗ.</p>\r\n                           <p>Xã Cam Hải Tây hiện có khoảng 900 ha xoài; trong đó 2/3 là diện tích trồng xoài Úc. Hiện đang vào chính vụ thu hoạch loại xoài này. Ông Nguyễn Minh Tâm - Chủ tịch Hội Nông dân xã Cam Hải Tây cho biết, so với thời điểm những năm trước, giá xoài xuống thấp hơn nhiều nhưng thị trường hiện tại vẫn đảm bảo đầu ra cho nông dân; vừa phục vụ thị trường xuất khẩu, vừa tiêu thụ trong nước.</p>\r\n                           <p>Huyện Cam Lâm là địa bàn trọng điểm trồng xoài của tỉnh Khánh Hòa với tổng diện tích khoảng 5.000 ha; trong đó có trên 3.000 ha xoài Úc dành cho xuất khẩu với sản lượng khoảng 500 - 700 tấn/năm. Thị trường chính của loại xoài này đa phần xuất khẩu đi Trung Quốc. Những năm qua, giá xoài luôn đạt mức cao, thậm chí có thời điểm lên đến 120.000 đồng/kg, giúp người dân thu về hàng trăm triệu đồng tiền lãi/ha mỗi năm.</p>\r\n                        </div>', '2021-01-30 11:03:19', 1, '1'),
(2, 'Xoài Úc tròn căng trên đất Khánh Hòa', 'Khánh Hòa có trên 8.000 ha xoài thì đến phân nửa trồng giống xoài Úc. Xoài Úc bén rễ đất Khánh Hòa cho chất lượng không thua kém vùng nguyên sản xứ sở Kanguru.', '/upload/news/blog-img-4.jpg', '<div class=\"title-news pb-4\"><h2>Thủ phủ\' xoài Úc Cam Lâm đã xuất khẩu trở lại</h2></div>\r\n                        <div class=\"blog-content\">\r\n                           <i>Sau thời gian không xuất khẩu được, đặc sản xoài Úc trồng tại huyện Cam Lâm (tỉnh Khánh Hòa) đã được thông quan trở lại. Tuy thị trường ở \"thủ phủ\" xoài này đã ấm lên nhưng giá xoài bán ra vẫn ở mức thấp khiến niềm vui của nhà vườn chưa trọn vẹn.</i>\r\n                           <div class=\"row mt-3 mb-3\">\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-1.jpg\" class=\"responsive\"></div>\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-2.jpg\" class=\"responsive\"></div>\r\n                           </div>\r\n                           <p>Những ngày này, vựa xoài Trường Lan ở huyện Cam Lâm đã tất bật người phân loại, đóng gói, xếp “rổ” xoài để chuẩn bị cho xe container đến chở ra phía Bắc xuất khẩu sang Trung Quốc. Trên những \"rổ\" xoài được đóng gói kỹ càng, bên cạnh dòng chữ nước ngoài thể hiện nguồn gốc xuất xứ của sản phẩm, chủ vựa cũng không quên để thêm dòng tiếng Việt “Úc 1” để chứng minh đây là hàng loại ngon.</p>\r\n                           <p>Ông Trường - chủ vựa xoài Trường Lan cho hay, hiện các cửa khẩu đã mở cửa bình thường nhưng hạn chế số lượng xuất hàng nên xoài vẫn bị ùn ứ. Tình trạng này khiến chi phí tăng vì phải chi trả tiền thuê xe, thuê phòng nghỉ cho tài xế chờ ở cửa khẩu… Tính ra, chi phí cho mỗi \"rổ\" 25 kg xoài mất tới 300.000 đồng để đưa từ vựa đến khi xuất bán sang nước ngoài - cao gấp đôi so với trước đây.</p>\r\n                           <p>Mỗi ngày vựa của ông Trường thu mua khoảng 20 tấn xoài, đủ một container để xuất đi Trung Quốc, tương đương các thời điểm trước khi có dịch COVID-19. Tuy nhiên, dự báo thời gian tới, việc tiêu thụ có thể chậm hơn vì gặp nhiều khó khăn về thủ tục ở cửa khẩu; trong khi xoài lại bắt đầu chín rộ khiến ông Trường vẫn lo lắng.</p>\r\n                           <p>Thời điểm sau Tết Nguyên đán, do dịch COVID-19 hoành hành khiến các cửa khẩu tạm đóng nên thị trường xuất khẩu xoài sang Trung Quốc phải tạm dừng. Thời gian gần đây, sau khi cửa khẩu Việt - Trung thông quan trở lại, việc tiêu thụ xoài của người dân đã thuận lợi hơn. Nhiều vựa thu mua xoài ở Cam Lâm phục vụ thị trường xuất khẩu đã hoạt động trở lại, sức mua đều hơn so với thời điểm 1 - 2 tháng trước đây. Tuy nhiên, hiện giá xoài thu mua chỉ ở mức thấp, dao động từ 15.000 - 20.000 đồng/kg tuỳ loại, trong khi thời điểm này mọi năm có giá từ 30.000 - 40.000 đồng/kg.</p>\r\n                           <p>Ông Diệp Thế Thanh - một hộ dân trồng xoài theo tiêu chuẩn VietGAP ở xã Cam Hải Tây, huyện Cam Lâm cho biết, xoài của ông hiện được thương lái thu mua với giá 19.000 - 20.000 đồng/kg do ông trồng và chăm sóc theo tiêu chuẩn sạch, an toàn nên chất lượng rất đảm bảo. Với mức giá này, thực tế người trồng xoài như ông không có lãi nhưng không đến nỗi phải chịu thua lỗ.</p>\r\n                           <p>Xã Cam Hải Tây hiện có khoảng 900 ha xoài; trong đó 2/3 là diện tích trồng xoài Úc. Hiện đang vào chính vụ thu hoạch loại xoài này. Ông Nguyễn Minh Tâm - Chủ tịch Hội Nông dân xã Cam Hải Tây cho biết, so với thời điểm những năm trước, giá xoài xuống thấp hơn nhiều nhưng thị trường hiện tại vẫn đảm bảo đầu ra cho nông dân; vừa phục vụ thị trường xuất khẩu, vừa tiêu thụ trong nước.</p>\r\n                           <p>Huyện Cam Lâm là địa bàn trọng điểm trồng xoài của tỉnh Khánh Hòa với tổng diện tích khoảng 5.000 ha; trong đó có trên 3.000 ha xoài Úc dành cho xuất khẩu với sản lượng khoảng 500 - 700 tấn/năm. Thị trường chính của loại xoài này đa phần xuất khẩu đi Trung Quốc. Những năm qua, giá xoài luôn đạt mức cao, thậm chí có thời điểm lên đến 120.000 đồng/kg, giúp người dân thu về hàng trăm triệu đồng tiền lãi/ha mỗi năm.</p>\r\n                        </div>', '2021-01-30 11:03:27', 1, '2'),
(3, 'Niềm vui xoài trái vụ…', 'Chưa bao giờ người trồng xoài ở Cam Lâm có được mùa xoài trái vụ mỹ mãn như năm nay. Xoài được mùa, được giá, nhiều gia đình rất phấn khởi vì có nguồn thu khá… Được mùa, được giá Những ngày này, nhiều hộ trồng xoài cát Hòa Lộc, xoài Canh Nông', '/upload/news/blog-img-5.jpg', '<div class=\"title-news pb-4\"><h2>Thủ phủ\' xoài Úc Cam Lâm đã xuất khẩu trở lại</h2></div>\r\n                        <div class=\"blog-content\">\r\n                           <i>Sau thời gian không xuất khẩu được, đặc sản xoài Úc trồng tại huyện Cam Lâm (tỉnh Khánh Hòa) đã được thông quan trở lại. Tuy thị trường ở \"thủ phủ\" xoài này đã ấm lên nhưng giá xoài bán ra vẫn ở mức thấp khiến niềm vui của nhà vườn chưa trọn vẹn.</i>\r\n                           <div class=\"row mt-3 mb-3\">\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-1.jpg\" class=\"responsive\"></div>\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-2.jpg\" class=\"responsive\"></div>\r\n                           </div>\r\n                           <p>Những ngày này, vựa xoài Trường Lan ở huyện Cam Lâm đã tất bật người phân loại, đóng gói, xếp “rổ” xoài để chuẩn bị cho xe container đến chở ra phía Bắc xuất khẩu sang Trung Quốc. Trên những \"rổ\" xoài được đóng gói kỹ càng, bên cạnh dòng chữ nước ngoài thể hiện nguồn gốc xuất xứ của sản phẩm, chủ vựa cũng không quên để thêm dòng tiếng Việt “Úc 1” để chứng minh đây là hàng loại ngon.</p>\r\n                           <p>Ông Trường - chủ vựa xoài Trường Lan cho hay, hiện các cửa khẩu đã mở cửa bình thường nhưng hạn chế số lượng xuất hàng nên xoài vẫn bị ùn ứ. Tình trạng này khiến chi phí tăng vì phải chi trả tiền thuê xe, thuê phòng nghỉ cho tài xế chờ ở cửa khẩu… Tính ra, chi phí cho mỗi \"rổ\" 25 kg xoài mất tới 300.000 đồng để đưa từ vựa đến khi xuất bán sang nước ngoài - cao gấp đôi so với trước đây.</p>\r\n                           <p>Mỗi ngày vựa của ông Trường thu mua khoảng 20 tấn xoài, đủ một container để xuất đi Trung Quốc, tương đương các thời điểm trước khi có dịch COVID-19. Tuy nhiên, dự báo thời gian tới, việc tiêu thụ có thể chậm hơn vì gặp nhiều khó khăn về thủ tục ở cửa khẩu; trong khi xoài lại bắt đầu chín rộ khiến ông Trường vẫn lo lắng.</p>\r\n                           <p>Thời điểm sau Tết Nguyên đán, do dịch COVID-19 hoành hành khiến các cửa khẩu tạm đóng nên thị trường xuất khẩu xoài sang Trung Quốc phải tạm dừng. Thời gian gần đây, sau khi cửa khẩu Việt - Trung thông quan trở lại, việc tiêu thụ xoài của người dân đã thuận lợi hơn. Nhiều vựa thu mua xoài ở Cam Lâm phục vụ thị trường xuất khẩu đã hoạt động trở lại, sức mua đều hơn so với thời điểm 1 - 2 tháng trước đây. Tuy nhiên, hiện giá xoài thu mua chỉ ở mức thấp, dao động từ 15.000 - 20.000 đồng/kg tuỳ loại, trong khi thời điểm này mọi năm có giá từ 30.000 - 40.000 đồng/kg.</p>\r\n                           <p>Ông Diệp Thế Thanh - một hộ dân trồng xoài theo tiêu chuẩn VietGAP ở xã Cam Hải Tây, huyện Cam Lâm cho biết, xoài của ông hiện được thương lái thu mua với giá 19.000 - 20.000 đồng/kg do ông trồng và chăm sóc theo tiêu chuẩn sạch, an toàn nên chất lượng rất đảm bảo. Với mức giá này, thực tế người trồng xoài như ông không có lãi nhưng không đến nỗi phải chịu thua lỗ.</p>\r\n                           <p>Xã Cam Hải Tây hiện có khoảng 900 ha xoài; trong đó 2/3 là diện tích trồng xoài Úc. Hiện đang vào chính vụ thu hoạch loại xoài này. Ông Nguyễn Minh Tâm - Chủ tịch Hội Nông dân xã Cam Hải Tây cho biết, so với thời điểm những năm trước, giá xoài xuống thấp hơn nhiều nhưng thị trường hiện tại vẫn đảm bảo đầu ra cho nông dân; vừa phục vụ thị trường xuất khẩu, vừa tiêu thụ trong nước.</p>\r\n                           <p>Huyện Cam Lâm là địa bàn trọng điểm trồng xoài của tỉnh Khánh Hòa với tổng diện tích khoảng 5.000 ha; trong đó có trên 3.000 ha xoài Úc dành cho xuất khẩu với sản lượng khoảng 500 - 700 tấn/năm. Thị trường chính của loại xoài này đa phần xuất khẩu đi Trung Quốc. Những năm qua, giá xoài luôn đạt mức cao, thậm chí có thời điểm lên đến 120.000 đồng/kg, giúp người dân thu về hàng trăm triệu đồng tiền lãi/ha mỗi năm.</p>\r\n                        </div>', '2021-01-30 11:03:37', 1, '3'),
(4, 'Xoài Úc trồng tại Khánh Hòa', 'Những trái xoài Úc to tròn, đỏ hồng, ngọt lịm trông rất bắt mắt đang có mặt ở các siêu thị châu Âu, nhìn nó không ai nghĩ những trái xoài này có xuất xứ từ tỉnh Khánh Hòa của Việt Nam. Thế nhưng, trên mảnh đất khô cằn này rất thích hợp với giống', '/upload/news/blog-img-6.jpg', '<div class=\"title-news pb-4\"><h2>Thủ phủ\' xoài Úc Cam Lâm đã xuất khẩu trở lại</h2></div>\r\n                        <div class=\"blog-content\">\r\n                           <i>Sau thời gian không xuất khẩu được, đặc sản xoài Úc trồng tại huyện Cam Lâm (tỉnh Khánh Hòa) đã được thông quan trở lại. Tuy thị trường ở \"thủ phủ\" xoài này đã ấm lên nhưng giá xoài bán ra vẫn ở mức thấp khiến niềm vui của nhà vườn chưa trọn vẹn.</i>\r\n                           <div class=\"row mt-3 mb-3\">\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-1.jpg\" class=\"responsive\"></div>\r\n                              <div class=\"col-md-6\"><img src=\"../upload/news/news-img-2.jpg\" class=\"responsive\"></div>\r\n                           </div>\r\n                           <p>Những ngày này, vựa xoài Trường Lan ở huyện Cam Lâm đã tất bật người phân loại, đóng gói, xếp “rổ” xoài để chuẩn bị cho xe container đến chở ra phía Bắc xuất khẩu sang Trung Quốc. Trên những \"rổ\" xoài được đóng gói kỹ càng, bên cạnh dòng chữ nước ngoài thể hiện nguồn gốc xuất xứ của sản phẩm, chủ vựa cũng không quên để thêm dòng tiếng Việt “Úc 1” để chứng minh đây là hàng loại ngon.</p>\r\n                           <p>Ông Trường - chủ vựa xoài Trường Lan cho hay, hiện các cửa khẩu đã mở cửa bình thường nhưng hạn chế số lượng xuất hàng nên xoài vẫn bị ùn ứ. Tình trạng này khiến chi phí tăng vì phải chi trả tiền thuê xe, thuê phòng nghỉ cho tài xế chờ ở cửa khẩu… Tính ra, chi phí cho mỗi \"rổ\" 25 kg xoài mất tới 300.000 đồng để đưa từ vựa đến khi xuất bán sang nước ngoài - cao gấp đôi so với trước đây.</p>\r\n                           <p>Mỗi ngày vựa của ông Trường thu mua khoảng 20 tấn xoài, đủ một container để xuất đi Trung Quốc, tương đương các thời điểm trước khi có dịch COVID-19. Tuy nhiên, dự báo thời gian tới, việc tiêu thụ có thể chậm hơn vì gặp nhiều khó khăn về thủ tục ở cửa khẩu; trong khi xoài lại bắt đầu chín rộ khiến ông Trường vẫn lo lắng.</p>\r\n                           <p>Thời điểm sau Tết Nguyên đán, do dịch COVID-19 hoành hành khiến các cửa khẩu tạm đóng nên thị trường xuất khẩu xoài sang Trung Quốc phải tạm dừng. Thời gian gần đây, sau khi cửa khẩu Việt - Trung thông quan trở lại, việc tiêu thụ xoài của người dân đã thuận lợi hơn. Nhiều vựa thu mua xoài ở Cam Lâm phục vụ thị trường xuất khẩu đã hoạt động trở lại, sức mua đều hơn so với thời điểm 1 - 2 tháng trước đây. Tuy nhiên, hiện giá xoài thu mua chỉ ở mức thấp, dao động từ 15.000 - 20.000 đồng/kg tuỳ loại, trong khi thời điểm này mọi năm có giá từ 30.000 - 40.000 đồng/kg.</p>\r\n                           <p>Ông Diệp Thế Thanh - một hộ dân trồng xoài theo tiêu chuẩn VietGAP ở xã Cam Hải Tây, huyện Cam Lâm cho biết, xoài của ông hiện được thương lái thu mua với giá 19.000 - 20.000 đồng/kg do ông trồng và chăm sóc theo tiêu chuẩn sạch, an toàn nên chất lượng rất đảm bảo. Với mức giá này, thực tế người trồng xoài như ông không có lãi nhưng không đến nỗi phải chịu thua lỗ.</p>\r\n                           <p>Xã Cam Hải Tây hiện có khoảng 900 ha xoài; trong đó 2/3 là diện tích trồng xoài Úc. Hiện đang vào chính vụ thu hoạch loại xoài này. Ông Nguyễn Minh Tâm - Chủ tịch Hội Nông dân xã Cam Hải Tây cho biết, so với thời điểm những năm trước, giá xoài xuống thấp hơn nhiều nhưng thị trường hiện tại vẫn đảm bảo đầu ra cho nông dân; vừa phục vụ thị trường xuất khẩu, vừa tiêu thụ trong nước.</p>\r\n                           <p>Huyện Cam Lâm là địa bàn trọng điểm trồng xoài của tỉnh Khánh Hòa với tổng diện tích khoảng 5.000 ha; trong đó có trên 3.000 ha xoài Úc dành cho xuất khẩu với sản lượng khoảng 500 - 700 tấn/năm. Thị trường chính của loại xoài này đa phần xuất khẩu đi Trung Quốc. Những năm qua, giá xoài luôn đạt mức cao, thậm chí có thời điểm lên đến 120.000 đồng/kg, giúp người dân thu về hàng trăm triệu đồng tiền lãi/ha mỗi năm.</p>\r\n                        </div>', '2021-01-30 11:03:45', 1, '4');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL COMMENT 'mã đơn hàng',
  `email` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `promotion` double DEFAULT 0,
  `id_delivery` int(11) DEFAULT NULL,
  `fee_delivery` double DEFAULT 0,
  `total` double DEFAULT NULL,
  `id_payment` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT '0 : Khởi tạo đơn hàng\r\n1 : Xác nhận đơn hàng\r\n2 : Đang vận chuyển đơn hàng\r\n3 : Đã giao hàng\r\n-1: Đã hủy đơn hàng\r\n',
  `created` datetime DEFAULT NULL,
  `sendmail` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `code`, `email`, `name`, `phone`, `address`, `promotion`, `id_delivery`, `fee_delivery`, `total`, `id_payment`, `note`, `status`, `created`, `sendmail`) VALUES
(1, 'ETECH_161216', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 110000, 1, 'Gọi tôi trước khi giao hàng', 1, '2021-02-02 15:26:54', 1),
(2, 'ETECH_16121', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 180000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:26:58', 1),
(3, 'ETECH_1612169', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 140000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:27:01', 1),
(4, 'ETECH_16121694', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 280000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:27:04', 1),
(5, 'ETECH_1612169439', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 232000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:27:07', 1),
(6, 'ETECH_161216943110', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 130000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:27:10', 1),
(7, 'ETECH_1612129431', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 140000, 1, 'Gọi tôi trước khi giao hàng', 3, '2021-02-02 15:27:16', 1),
(8, 'ETECH_1612159431', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 600000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:27:19', 1),
(9, 'ETECH_1612139431', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 100000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:27:22', 1),
(10, 'ETECH_161289431', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 340000, 1, 'Gọi tôi trước khi giao hàng', 0, '2021-02-02 15:27:25', 1),
(11, 'ETECH_1612160431', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 0, 200000, 1, 'Gọi tôi trước khi giao hàng', 1, '2021-02-02 15:27:27', 1),
(12, 'ETECH_1612169730', '', 'Phan Minh Nhật', '0909 567 545', '132-134 Nguyễn Gia Trí, p.25, Bình Thạnh, HCM', 0, 1, 50000, 630000, 1, 'Gọi tôi trước khi giao hàng', -1, '2021-02-02 15:27:30', 1),
(14, 'ETECH_1612169618', 'xmen.man@gmail.com', 'asdsad', '0939657357', '234 D2 Binh Thanh', 0, 1, 110, 5800000, 1, '', 0, '2021-02-02 15:27:39', 1),
(15, 'ETECH_1612228796', 'duyngocnb@gmail.com', 'Lai Ngoc Duy', '0939657357', '566 Thai Son P5 Go Vap TPHCM', 0, 1, 50000, 150000, 1, 'asdasdasd', 0, '2021-02-02 15:27:43', 1),
(16, 'ETECH_1612229278', 'duyngocnb@gmail.com', 'Duong Ba Tuyen', '0939657357', 'Ha Tinh Nghe An', 0, 1, 879, 11632000, 1, 'giao hang gap cho khach', 2, '2021-02-02 15:27:46', 1),
(17, 'ETECH_1612229402', 'xmen.man@gmail.com', 'cung cap banh ke', '123445', '234 D2 Binh Thanh', 0, 1, 879, 11632000, 1, 'asdasda', 4, '2021-02-02 15:27:49', 1),
(18, 'ETECH_1612229545', 'xmen.masn@gmail.com', 'bong da ngoi sao', '0939657357', '655 Thai SOn ', 0, 1, 879, 11632000, 1, 'asdasdasd', 0, '2021-02-02 15:27:52', 1),
(19, 'ETECH_1612240201', 'xmen.man@gmail.com', 'cung cap banh ke', '1234557', '234 D2 Binh Thanh', 0, 1, 5000, 825000, 1, '', 3, '2021-02-02 15:27:55', 0),
(20, 'ETECH_1612251783', 'orchipro@gmail.com', 'TUAN ANH DANG', '0774921898', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 240000, 1, '', 1, '2021-02-02 15:27:58', 0),
(21, 'ETECH_1612251938', 'orchipro1@gmail.com', 'TUAN ANH DANG1', '07749218981', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh 1', 0, 1, 50000, 150000, 1, 'Giao hàng 1', 1, '2021-02-02 15:28:01', 0),
(22, 'ETECH_1612261675', 'xmen.man@gmail.com', 'cung cap banh ke', 'asdasdasd', '234 D2 Binh Thanh', 0, 2, 0, 190000, 1, '', 1, '2021-02-02 17:27:55', 0),
(23, 'ETECH_1612319671', '', 'aas', '324', '3rr', 0, 2, 70000, 500000, 1, '', 1, '2021-02-03 09:34:31', 0),
(24, 'ETECH_1612319918', 'xmen.man@gmail.com', 'cung cap banh ke', '43434', '234 D2 Binh Thanh', 0, 1, 50000, 240000, 1, '', 1, '2021-02-03 09:38:38', 0),
(25, 'ETECH_1612320898', '', 'Nguyễn Tâm', '0908123456', '132-134 Nguyễn Gia Trí , p.25, Q.Bình Thạnh, HCM', 0, 1, 50000, 550000, 1, 'Giao hàng giờ hành chính. Gọi tôi trước khi giao hàng', 1, '2021-02-03 09:54:58', 0),
(26, 'ETECH_1612320900', '', 'lai ngoc duy', '78954566', '566 thai son phuong 5 go vap', 0, 2, 5000, 1155000, 1, '', 1, '2021-02-03 09:55:00', 0),
(27, 'ETECH_1612321267', 'hoangtamau@gmail.com', 'Nguyễn Tâm 1', '0909 746 520', '132-134 Nguyễn Gia Trí p.25, Bình Thạnh, HCM', 0, 1, 50000, 200000, 1, 'Giao hàng giờ hành chính. Gọi tôi trước khi giao hàng', 3, '2021-02-03 10:01:07', 0),
(28, 'ETECH_1612321459', '', 'Nguyễn Tâm 2', '0909 123 890', 'Bình Thạnh Hồ Chí Minh', 0, 1, 50000, 220000, 1, 'test', -1, '2021-02-03 10:04:19', 0),
(29, 'ETECH_1612322089', '23', 'bong da', '45234', 'asdasd', 0, 2, 333, 260333, 1, 'werqweqwe', 0, '2021-02-03 10:14:49', 0),
(30, 'ETECH_1612401862', '', 'TUAN ANH DANG', '0774921898', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 210000, 1, 'abcd', 0, '2021-02-04 08:24:22', 0),
(31, 'ETECH_1612402513', '', 'TUAN ANH DANG', '0774921898', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 2, 333, 80333, 1, 'aaaaa', 0, '2021-02-04 08:35:13', 0),
(32, 'ETECH_1612403957', '', 'TUAN ANH DANG', '0774921898', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 130000, 1, 'sbcsdfsdf', 2, '2021-02-04 08:59:17', 1),
(33, 'ETECH_1612404350', '', 'TUAN ANH DANG', '212345678', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 120000, 1, 'abcd', 0, '2021-02-04 09:05:50', 0),
(34, 'ETECH_1612404466', '', 'TUAN ANH DANG', '212345678', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 130000, 1, '', 0, '2021-02-04 09:07:46', 0),
(35, 'ETECH_1612404633', '', 'TUAN ANH DANG', '212345678', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 170000, 1, '', 0, '2021-02-04 09:10:33', 0),
(36, 'ETECH_1612404772', '', 'TUAN ANH DANG', '212345678', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 120000, 1, '', 0, '2021-02-04 09:12:52', 0),
(37, 'ETECH_1612405193', '', 'TUAN ANH DANG', '0774921898', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 120000, 1, '', -1, '2021-02-04 09:19:53', 1),
(38, 'ETECH_1612500912', '', 'TUAN ANH DANG', '212345678', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 200000, 1, 'bfdgdf', 0, '2021-02-05 11:55:12', 0),
(39, 'ETECH_1612516403', '', 'TUAN ANH DANG', '0774921898', '57 đường 26 Phường 16 Quận 8 Hồ Chí Minh', 0, 1, 50000, 570000, 1, 'test', 0, '2021-02-05 16:13:23', 1),
(40, 'ETECH_1612664737', '', 'Nguyễn Trương Thành Luân', '0938454986', '132-134 Nguyễn Gia Trí, P.25', 0, 1, 50000, 200000, 1, '', -1, '2021-02-07 09:25:37', 0),
(41, 'ETECH_1622258436', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm', '0383502890', 'HT Bulding 132 Nguyễn Gia Trí, P.25, Quận Bình Thạnh, Hồ Chí Minh', 0, 1, 30000, 150000, 1, '', 4, '2021-05-29 10:20:36', 0),
(42, 'ETECH_1622258520', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm', '0383502890', 'HT Bulding 132 Nguyễn Gia Trí, P.25, Quận Bình Thạnh, Hồ Chí Minh', 0, 1, 30000, 150000, 1, '', -1, '2021-05-29 10:22:00', 0),
(43, 'ETECH_1622258858', 'hoangtamau@gmail.com', 'Nguyễn Hoàng', '0909123879', '132 Nguyễn Gia Trí, P.25, Quận Bình Thạnh, Hồ Chí Minh', 1, 1, 30000, 300000, 1, 'ghi chú', 4, '2021-05-29 10:27:38', 0),
(44, 'ETECH_1622259054', '1', '1', '1', '1, 1, 1, 1', 0, 1, 30000, 150000, 1, '111', 4, '2021-05-29 10:30:54', 0),
(45, 'ETECH_1622259189', '2', '2', '2', '2, 2, 2, 2', 1, 1, 30000, 900000, 1, 'gh2', 4, '2021-05-29 10:33:09', 0),
(46, 'ETECH_1622259275', '3', '3', '3', '3, 3, 3, 3', 0, 1, 30000, 150000, 1, '3', 4, '2021-05-29 10:34:35', 0),
(47, 'ETECH_1622259465', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm 4', '+849099244331', '132 Nguyễn Gia Trí', 0, 1, 3000, 150000, 1, 'ghi chú 4', 4, '2021-05-29 10:37:45', 0),
(48, 'ADMIN_1622447301', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm', '+849099244331', '132 Nguyễn Gia Trí', 1, 1, 20000, 15, 1, 'ghi chú 2211', 0, '2021-05-31 14:48:21', 0),
(49, 'ADMIN_1622515278', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm', '+849099244331', '132 Nguyễn Gia Trí', 1, 1, 5000, 9, 1, 'Ghi cú', 1, '2021-06-01 09:41:18', 0),
(50, 'ADMIN_1622516499', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm', '+849099244331', '132 Nguyễn Gia Trí', 1, 1, 15000, 135000, 1, 'Ghi chú 11', 4, '2021-06-01 10:01:39', 0),
(51, 'WEB_1622517376', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm', '0383502890', '1, 1, 1, Hồ Chí Minh', 0, 1, 30000, 425000, 1, '', 2, '2021-06-01 10:16:16', 0),
(52, 'ADMIN_1622703867', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm', '+849099244331', '132 Nguyễn Gia Trí', 0, 1, 5000, 110000, 1, '', 0, '2021-06-03 14:04:27', 0),
(53, 'ADMIN_1622704153', 'hoangtamau@gmail.com', 'Nguyễn Hoàng Tâm1987 ', '+849099244331', '132 Nguyễn Gia Trí', 1, 1, 4000, 186000, 1, '', 0, '2021-06-03 14:09:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quatity` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_order`, `id_product`, `price`, `quatity`, `status`) VALUES
(1, 1, 1, 50000, 2, 1),
(2, 1, 1, 10000, 1, 1),
(3, 2, 1, 20000, 1, 1),
(4, 2, 1, 30000, 2, 1),
(5, 2, 1, 50000, 2, 1),
(6, 3, 1, 50000, 2, 1),
(7, 3, 1, 20000, 2, 1),
(8, 4, 1, 40000, 2, 1),
(9, 4, 1, 45000, 2, 1),
(10, 4, 1, 55000, 2, 1),
(11, 5, 1, 57000, 2, 1),
(12, 5, 1, 59000, 2, 1),
(13, 6, 1, 65000, 2, 1),
(14, 7, 1, 70000, 2, 1),
(15, 8, 1, 100000, 5, 1),
(16, 8, 1, 30000, 2, 1),
(17, 8, 1, 20000, 2, 1),
(18, 9, 1, 30000, 2, 1),
(19, 9, 1, 20000, 2, 1),
(20, 10, 1, 10000, 2, 1),
(21, 10, 1, 90000, 2, 1),
(22, 10, 1, 70000, 2, 1),
(23, 11, 1, 60000, 2, 1),
(24, 11, 1, 40000, 2, 1),
(25, 12, 1, 30000, 2, 1),
(26, 12, 1, 10000, 2, 1),
(27, 12, 1, 100000, 5, 1),
(28, 13, 1, 5456456, 1, 1),
(29, 13, 1, 343434, 1, 1),
(30, 14, 1, 5456456, 1, 1),
(31, 14, 1, 343434, 1, 1),
(32, 15, 1, 100000, 1, 1),
(33, 16, 1, 100000, 36, 1),
(34, 16, 1, 5456456, 1, 1),
(35, 16, 1, 2342342, 1, 1),
(36, 16, 1, 232323, 1, 1),
(37, 17, 1, 100000, 36, 1),
(38, 17, 1, 5456456, 1, 1),
(39, 17, 1, 2342342, 1, 1),
(40, 17, 1, 232323, 1, 1),
(41, 18, 1, 100000, 36, 1),
(42, 18, 1, 5456456, 1, 1),
(43, 18, 1, 2342342, 1, 1),
(44, 18, 1, 232323, 1, 1),
(45, 19, 1, 100000, 5, 1),
(46, 19, 1, 100000, 1, 1),
(47, 19, 1, 110000, 2, 1),
(48, 20, 1, 70000, 1, 1),
(49, 20, 1, 120000, 1, 1),
(50, 21, 1, 100000, 1, 1),
(51, 22, 1, 70000, 1, 1),
(52, 22, 1, 120000, 1, 1),
(53, 23, 1, 100000, 2, 1),
(54, 23, 1, 120000, 1, 1),
(55, 23, 1, 110000, 1, 1),
(56, 24, 1, 70000, 1, 1),
(57, 24, 1, 120000, 1, 1),
(58, 25, 1, 100000, 3, 1),
(59, 25, 1, 90000, 1, 1),
(60, 25, 1, 110000, 1, 1),
(61, 26, 1, 100000, 7, 1),
(62, 26, 1, 90000, 5, 1),
(63, 27, 1, 80000, 1, 1),
(64, 27, 1, 70000, 1, 1),
(65, 28, 1, 70000, 1, 1),
(66, 28, 1, 100000, 1, 1),
(67, 29, 1, 80000, 1, 1),
(68, 29, 1, 70000, 1, 1),
(69, 29, 1, 110000, 1, 1),
(70, 30, 1, 80000, 2, 1),
(71, 31, 1, 80000, 1, 1),
(72, 32, 1, 80000, 1, 1),
(73, 33, 1, 70000, 1, 1),
(74, 34, 1, 80000, 1, 1),
(75, 35, 1, 120000, 1, 1),
(76, 36, 1, 70000, 1, 1),
(77, 37, 1, 70000, 1, 1),
(78, 38, 1, 150000, 1, 1),
(79, 39, 1, 150000, 2, 1),
(80, 39, 1, 110000, 2, 1),
(81, 40, 1, 150000, 1, 1),
(82, 41, 1, 30000, 5, 1),
(83, 42, 1, 30000, 5, 1),
(84, 43, 1, 30000, 10, 1),
(85, 44, 1, 30000, 5, 1),
(86, 45, 1, 30000, 30, 1),
(87, 46, 1, 30000, 5, 1),
(88, 47, 1, 30000, 5, 1),
(89, 48, 1, 3, 5, 1),
(90, 49, 1, 3, 3, 1),
(91, 50, 1, 30000, 2, 1),
(92, 50, 2, 25000, 3, 1),
(93, 51, 1, 30000, 10, 1),
(94, 51, 2, 25000, 5, 1),
(95, 53, 1, 35000, 4, 1),
(96, 53, 2, 23000, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `pricesale` double DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `slug` text DEFAULT NULL,
  `isDelete` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `pricesale`, `content`, `status`, `slug`, `isDelete`) VALUES
(1, 'Xoài Úc Cam Lâm', '/upload/product/pro-3.jpg', 30000, 30000, '<p>asdasdq2313123</p>\r\n', 1, 'Xoai-Uc-Cam-Lam', 0),
(2, 'test', '/upload/1622515753.jpg', 25000, 20000, '<p>d</p>\r\n', 1, 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idx` int(11) NOT NULL,
  `ID` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT 'KR',
  `status` int(11) DEFAULT 0 COMMENT '0: chưa active\r\n1 active',
  `area` varchar(255) DEFAULT 'KR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idx`, `ID`, `password`, `lang`, `status`, `area`) VALUES
(14, 'tbridge', 'bc6536290de471b70170be7b83969775', 'KR', 1, 'KR'),
(20, 'orchipro', '91c0eda011d083363259069b36f4e4b0', 'KR', 1, 'VN'),
(88, '123456', '81dc9bdb52d04dc20036dbd8313ed055', 'VN', 1, 'KR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idx`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
