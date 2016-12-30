--
-- Create the product answer filter table
--
CREATE TABLE IF NOT EXISTS `#__ifm_product_answers`
	(`id` INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	 `prodName` VARCHAR(80) NOT NULL,
	 `prodDesc` VARCHAR(255) NOT NULL,
	 `concreteType` VARCHAR(20),
	 `pourType` VARCHAR(20),
	 `slump` VARCHAR(20),
	 `pourSize` VARCHAR(20),
	 `pourRate` VARCHAR(20),
	 `reinforcement` VARCHAR(20),
	 `flatness` VARCHAR(20),
	 `grade` VARCHAR(20),
	 `placement` VARCHAR(20),
	 `prepSubGrade` VARCHAR(20),
	 `weight` VARCHAR(20));

--
-- Populate the table
--
INSERT INTO `#__ifm_product_answers` (`prodName`, `prodDesc`, `prodImage`,
								`concreteType`, `pourType`, `slump`, `pourSize`,
								`pourRate`,`reinforcement`, `flatness`, `grade`,
								`placement`, `prepSubGrade`, `weight`)
						VALUES ("CopperHead Laser Screed",
						        "Introduced in 2002, the CopperHead is a Laser Screed that can be taken to places other Laser Screeds couldn't reach!",
								"copperheadxd3.jpg",
								"ABC", "AB", "ABC", "ABCD", "ABC", "ABC", "A",
								"ABC", "ABC", "AB", "AB");

INSERT INTO `#__ifm_product_answers` (`prodName`, `prodDesc`, `prodImage`,
								`concreteType`, `pourType`, `slump`, `pourSize`,
								`pourRate`, `reinforcement`, `flatness`, `grade`,
								`placement`, `prepSubGrade`, `weight`)
						VALUES ("SXP-Diagnostic Laser Screed",
						        "Introducing the most technologically advanced Laser Screed available.",
								"sxp-d.jpg",
								"ABC", "AB", "ABC", "CDE", "CD", "ABC", "B",
								"ABC", "A", "AB", "AB");

INSERT INTO `#__ifm_product_answers` (`prodName`, `prodDesc`, `prodImage`,
								`concreteType`, `pourType`, `slump`, `pourSize`,
								`pourRate`,`reinforcement`, `flatness`, `grade`,
								`placement`, `prepSubGrade`, `weight`)
						VALUES ("Mini Screed C",
								"Superior productivity and flatness with the Mini Screed C. Its what you have come to expect from Somero®",
								"miniscreed-c.jpg",
								"ABC", "AB", "ABC", "AB", "A", "ABC", "A",
								"AB", "ABC", "AB", "AB");

INSERT INTO `#__ifm_product_answers` (`prodName`, `prodDesc`, `prodImage`,
								`concreteType`, `pourType`, `slump`, `pourSize`,
								`pourRate`, `reinforcement`, `flatness`, `grade`,
								`placement`, `prepSubGrade`, `weight`)
						VALUES ("Power Rake",
								"The PowerRake® 2.0 is the most powerful concrete raking tool you’ll ever need!",
								"PowerRake.jpg",
								"ABC", "AB", "ABC", "CDE", "ABCD", "AB", "AB",
								"AB", "ABC", "AB", "AB");

INSERT INTO `#__ifm_product_answers` (`prodName`, `prodDesc`, `prodImage`,
								`concreteType`, `pourType`, `slump`, `pourSize`,
								`pourRate`, `reinforcement`, `flatness`, `grade`,
								`placement`, `prepSubGrade`, `weight`)
						VALUES ("3-D Profiler",
								"The Somero 3-D Profiler System is a technological breakthrough which allows concrete to be placed over contoured sites automatically using a Somero Laser Screed.",
								"3D_ProfilerSystem.png",
								"ABC", "AB", "ABC", "ABCDE", "ABCD", "AB", "AB",
								"C", "ABC", "AB", "AB");

INSERT INTO `#__ifm_product_answers` (`prodName`, `prodDesc`, `prodImage`,
								`concreteType`, `pourType`, `slump`, `pourSize`,
								`pourRate`, `reinforcement`, `flatness`, `grade`,
								`placement`, `prepSubGrade`, `weight`)
						VALUES ("Hose Hog",
								"The HoseHog™ is a unique combination of advanced technology and old fashion horsepower that removes the back-breaking and extremely labor-intensive task of dragging concrete hose either on elevated deck or slab on grade.",
								"bighog.jpg",
								"ABC", "AB", "ABC", "ABCDE", "ABCD", "AB", "AB",
								"ABC", "ABC", "AB", "AB");



--
-- Create the contact info table
--
CREATE TABLE IF NOT EXISTS `#__ifm_contact_data`
	(`id` INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	 `fname` VARCHAR(80) NOT NULL,
	 `lname` VARCHAR(80) NOT NULL,
	 `company` VARCHAR(255),
	 `email` VARCHAR(255),
	 `phone` VARCHAR(80),
	 `usedEquip` VARCHAR(255),
	 `familiar`  VARCHAR(255),
	 `purchPref` VARCHAR(80),
	 `concreteType` VARCHAR(80),
	 `pourType` VARCHAR(80),
	 `slump` VARCHAR(80),
	 `pourSize` VARCHAR(80),
	 `pourRate` VARCHAR(80),
	 `reinforcement` VARCHAR(80),
	 `flatness` VARCHAR(80),
	 `grade` VARCHAR(128),
	 `placement` VARCHAR(128),
	 `prepSubGrade` VARCHAR(80),
	 `weight` VARCHAR(80));
