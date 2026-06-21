-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql203.infinityfree.com
-- Generation Time: Jun 21, 2026 at 07:37 AM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_42222334_vijesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_croatian_ci NOT NULL,
  `prezime` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_croatian_ci NOT NULL,
  `lozinka` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_croatian_ci NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(11, 'admin', 'admin', 'admin1', '$2y$10$fKR2hv0AxrjN/TlX7ALHBO6vlgB0RTgHaOWoFDq4GT1kWY5vN6XUC', 1),
(12, 'super', 'admin', 'superadmin', '$2y$10$HVipboRZ5zFJQacIleQG8eGsgmP9bJMZ7MBXBCphPjk3rrI.yhY7O', 2),
(13, 'Ivan Mihael', 'Zec', 'Zekica247', '$2y$10$/WjQhn7WuOp.rjO0YDHJuegrQfv3nHxtVw6G5OBaBplAR/ZFI.Mo2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_croatian_ci NOT NULL,
  `puni_naslov` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `sazetak` text CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `kategorija` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `puni_naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(17, '2026-06-19', 'Dinamo doveo tinejdžera iz Gane', 'Dinamo doveo tinejdžera iz Gane', 'NAKON što je ranije ovog tjedna potvrđen dolazak mladog hrvatskog reprezentativca Gabrijela Šivaleca iz Slaven Belupa, Dinamo je dogovorio još jednu prinovu za B momčad koja će iduće sezone igrati drugu ligu. U redove Plavih stiže mladi ganski veznjak Fuzy Taylor.\r\n\r\nDetalji transfera nisu poznati, no Dinamo će imati mogućnost otkupa ugovora ako se mladi Ganac pokaže kao pojačanje tijekom posudbe. Prema planu, Taylor će igrati za B momčad koju će voditi Jerko Leko. U prošloj sezoni za prvake Gane odigrao je 28 utakmica i postigao jedan pogodak. Opisuju ga kao energičnog igrača koji je za svoju dob tehnički vrlo potkovan.Potvrda iz Gane\r\nVijest o transferu objavio je njegov dosadašnji klub Medeama SC, aktualni prvak Gane. Na svojim su službenim stranicama potvrdili da 18-godišnji Taylor odlazi u Dinamo na jednogodišnju posudbu. Sam igrač nije krio zadovoljstvo zbog prelaska u hrvatskog prvaka.', '6a355ed61386d.jpg', 'sport', 0),
(18, '2026-06-19', 'Gabrijel Šivalec je novi igrač Dinama', 'Gabrijel Šivalec je novi igrač Dinama', 'GABRIJEL ŠIVALEC (18) novi je igrač Dinama. \"Nadareni osamnaestogodišnjak, krilni napadač i hrvatski U19 reprezentativac, Gabi je danas potpisao višegodišnji ugovor s našim klubom. Na Maksimir dolazi iz Slaven Belupa pa znamo da mu plavi dres dobro stoji, a mi mu želimo dobrodošlicu i puno sreće!\", piše u objavi kluba. Za Dinamo bi trebao nastupati i za prvu i za drugu momčad, koja od iduće sezone igra 1. NL, drugi rang hrvatskog nogometa.', '6a355ecee24b5.jpg', 'sport', 0),
(19, '2026-06-19', 'Martinez prelazi u Juventus', 'Martinez prelazi u Juventus', 'JUVENTUS je pokazao interes za vratara Aston Ville Emija Martineza nakon što im je propao pokušaj dovođenja Alissona iz Liverpoola. Realizacija transfera uvelike će ovisiti o tome mogu li Talijani zadovoljiti financijske zahtjeve Aston Ville za argentinskog reprezentativca, koji je prošle godine bio na korak do prelaska u Manchester United, piše Daily Mail.\r\n\r\nPropao plan s Alissonom\r\nTorinski klub prvotno je ciljao Alissona, uvjeren da se Brazilac želi pridružiti momčadi te da je dogovor moguć s obzirom na to da mu ugovor istječe za samo godinu dana. Međutim, Liverpool nije u poziciji trošiti velik novac na zamjenu jer proračun namjerava iskoristiti za prioritetna pojačanja na drugim pozicijama.\r\n\r\nIz Liverpoola su stoga poručili Brazilcu da žele njegov ostanak te se čini da su mu spremni dopustiti da odradi ugovor do kraja. Alisson, koji je imao problema s ozljedama, odan je klubu i nije želio stvarati probleme, unatoč tome što ga je privlačila ideja povratka u Italiju, gdje je u Romi već surađivao s Juventusovim trenerom Lucianom Spallettijem.\r\n\r\nVilla spremna na odlazak Martineza\r\nAston Villa je računala na mogući odlazak 33-godišnjeg Martineza, zbog čega je pokazala interes za dovođenjem Jamesa Trafforda, vratara Manchester Cityja i engleske reprezentacije, kao njegove zamjene.', '6a355ec461103.jpeg', 'sport', 0),
(27, '2026-06-19', 'Bivši izraelski premijer', 'Bivši izraelski premijer: Netanyahua treba ukloniti štapovima i kamenjem\r\n', 'BIVŠI izraelski premijer Ehud Barak pozvao je na smjenu premijera Benjamina Netanyahua \"štapovima i kamenjem\" ako pokuša potkopati nadolazeće opće izbore.\r\n\r\nBarak, koji je bio na čelu izraelske vlade od 1999. do 2001., te je izjave dao u današnjem intervjuu za izraelski javni servis KAN.\r\n\r\n\"Netanyahu želi beskonačan rat\"\r\n\"Bojim se da bi Netanyahu mogao pokušati sabotirati izbore, a to može izvesti vrlo lako\", rekao je Barak. \"Ako to pokuša, nećemo imati drugog izbora nego da ga uklonimo štapovima i kamenjem.\"\r\n\r\nBarak tvrdi da bi Netanyahu mogao izazvati sabotažu pokretanjem vojnih operacija u Libanonu, što bi izazvalo odmazdu Hezbollaha i Irana.\r\n\r\n\"Netanyahu želi beskonačan rat jer shvaća da bi kraj rata ubrzao njegovo suđenje\", izjavio je Barak, dodavši kako je premijer već opstruirao dogovore o razmjeni zarobljenika s Hamasom i blokirao napredak u pregovorima koji se tiču Libanona.\r\n\r\nNetanyahu je na čelu aktualne vlade od kraja prosinca 2022. godine, a njegova se koalicija uvelike opisuje kao najdesnija u povijesti Izraela.\r\n\r\nAktualni saziv Knesseta istječe u listopadu 2026., a izbori se očekuju u rujnu ili listopadu. U Izraelu se protiv Netanyahua vodi sudski postupak zbog optužbi za korupciju, a od 2024. godine traži ga i Međunarodni kazneni sud (ICC) zbog optužbi za ratne zločine i zločine protiv čovječnosti u Gazi.\r\n\r\n', '6a355eba0cd86.jpg', 'politika', 0),
(33, '2026-06-19', 'Je li BiH zalutala na Svjetsko prvenstvo?', 'Je li BiH potpuno zalutala na Svjetsko prvenstvo?', 'BOSNA i Hercegovina u zadnjem kolu grupne faze igra protiv Katara. Azijski prvak jedna je od najlošijih ekipa na ovom prvenstvu, a protiv Kanade su izgubili čak 6:0, pri čemu su dobili i dva crvena kartona. Pobjeda bi susjednu državu gotovo sigurno gurnula u nokaut fazu jer bi tada imala četiri boda.\r\n\r\nPrema kladionicama, BiH je favorit s preko 65 %. Dobre vijesti staju otprilike tu. BiH je dosad na turniru bila jedna od najdosadnijih ekipa, a njezin nogomet je izrazito konzervativan i negativan. \r\n\r\nNesuvisla strategija protiv Švicarske\r\nBiH je protiv Švicarske od prve minute u potpunosti prepustila suparniku posjed i kontrolu nad tempom susreta. To je donekle očekivano jer je Švicarska bila osjetan favorit i generalno je bolja reprezentacija. No, u kontekstu ostatka konkurencije na turniru, ni Kanada ni Švicarska ne spadaju u svjetsku kremu, a BiH se u obje utakmice postavila kao da igra protiv Francuske.\r\n\r\nTa je činjenica utoliko poraznija ako se zna da bod protiv Švicarske ne bi pretjerano značio momčadi Sergeja Barbareza. Remi ili poraz, BiH bi svakako u zadnjem kolu trebala pobijediti Katar. Jedino što je radilo značajnu razliku bila je pobjeda, a postavkom igre uvelike si je smanjila šanse da do nje dođe.\r\n\r\nKoja je ideja s Džekom?\r\nAko je primarna ideja bila ne primiti gol, onda je formacija 4-4-2 s dva napadača, od kojih je jedan 40-godišnji Edin Džeko, bila potpuno pogrešna odluka. Švicarska je rombom u sredini terena stalno opterećivala Ivana Šunjića i Benjamina Tahirovića, bosanske centralne veznjake, i bez problema je kontrolirala taj dio terena.\r\n\r\nBiH je zbog toga morala stajati vrlo usko na krilima, što je Švicarskoj otvorilo puno prostora na bočnim pozicijama. Otamo nisu previše toga kreirali jer nemaju naročitu klasu u situacijama 1 na 1, ali su na količinu napada dočekali dvije greške BiH: Memićevo izbijanje kontrolirane lopte na šut suparniku i crveni karton Muharemovića koji je prelomio susret.\r\n\r\nIako je suparnik vrlo kasno došao do potvrde pobjede, ne može se reći da je BiH odigrala dobru defenzivnu utakmicu. Branila se s gotovo svim igračima iza lopte, ali je taj blok bio izuzetno pasivan i omogućio je Švicarskoj dugačke napade.\r\n\r\nApsolutno ništa prema naprijed\r\nSama ta struktura BiH je jako ograničila u fazi napada. Švicarci su visoko dizali lijevog beka Rodrigueza koji je praktički postajao krilo jer nije bilo nikakve opasnosti da duboko postavljena Bosna iz kontre napada koridor iza njegovih leđa.\r\n\r\n', '6a355e3257a6f.jpg', 'sport', 0),
(34, '2026-06-19', 'Primorac je...', 'Primorac je opasna osoba', 'SABORSKI zastupnik Mosta Zvonimir Troskot gostovao je u Novom danu televizije N1, gdje je oštro komentirao aktualne političke teme. U istupu je vladajuću stranku usporedio s komunističkom partijom, optužio USKOK za pristranost te iznio teške optužbe na račun kandidata za predsjednika Hrvatskog olimpijskog odbora, Dragana Primorca. Ustvrdio je da ga ne bi iznenadilo da im se podmeću i kaznena djela, poput stavljanja droge u automobil, rekao je za N1.\r\n\r\n\r\n\r\n\r\n', '6a3560a39d842.jpg', 'politika', 0),
(35, '2026-06-20', 'Pitali smo mlade što je najveći problem njih.', 'Pitali smo mlade što je najveći problem njihove generacije, odgovori su bili iskreni', 'SVAKA generacija ima svoje navike, mane i izazove, a mladi danas često su na meti kritika starijih koji ih optužuju da previše vremena provode na društvenim mrežama, da su manje društveni ili da ih ne zanimaju važne društvene teme. No što o svemu tome misle oni sami?\r\n\r\nPitali smo mlade Hrvate koja je, prema njihovu mišljenju, najveća greška njihove generacije, a odgovori su pokazali da o sebi razmišljaju prilično kritično i iskreno.\r\n\"Ne radimo ništa puno lošije od drugih\"\r\nJedna djevojka smatra da se mladima često nepravedno pripisuju problemi koji nisu nužno njihova krivnja.\r\n\r\n\"Mislim da nemamo neku veliku grešku koju radimo. Mislim da je zabluda da neke generacije nešto rade puno lošije od drugih. Samo se nosimo s nekim novim problemima, ali mislim da zapravo jako dobro prolazimo kroz sve što možemo\", rekla je.\r\n\r\nDruštvene mreže kao najveći problem\r\nIpak, većina sugovornika kao najveći problem svoje generacije istaknula je upravo pretjeranu usmjerenost na društvene mreže i virtualni svijet.\r\n\r\n\"Manjak povjerenja. Puno ljubomore, puno fokusa na društvene mreže i rekla bih da je to najveća greška\", iskreno je priznala jedna djevojka.', '6a3674a87bb80.jpg', 'politika', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
