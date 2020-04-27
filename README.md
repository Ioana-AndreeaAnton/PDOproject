--
-- Structura tabel pentru tabel `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `images` (`id`, `title`, `image`) VALUES
(25087474, 'Popovici Alexandra Ecaterina', './images/clienti/e2fecd9d9cf1fb59ba31b16d306ab756team5.jpg'),
(1802532430, 'Mark Thomas', './images/clienti/76699dc21603008c55deb54279bd2597team4.jpg');


ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1802532431;

--
-- Structura tabel pentru tabel `images_update`
--

CREATE TABLE `images_update` (
  `title` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `edtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `images_update` (`title`, `status`, `edtime`) VALUES
('Popovici Alexandra', 'RECENTLY ADDED ', '2020-04-27'),
('Mark Thomas', 'RECENTLY ADDED ', '2020-04-27'),
('Eduard Laur', 'RECENTLY ADDED ', '2020-04-27'),
('Eduard Laur', 'DELETED', '2020-04-27'),
('Popovici Alexandra Ecaterina', 'RECENTLY UPDATED', '2020-04-27');


