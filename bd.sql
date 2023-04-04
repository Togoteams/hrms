CREATE TABLE `Users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(200) NOT NULL,
	`middle_name` VARCHAR(200) NOT NULL,
	`last_name` VARCHAR(200) NOT NULL,
	`email_id` VARCHAR(200) NOT NULL UNIQUE,
	`mobile_no` VARCHAR(200) NOT NULL UNIQUE,
	`username` VARCHAR(200) NOT NULL UNIQUE,
	`login_id` VARCHAR(200) NOT NULL UNIQUE,
	`email_verified_at` DATETIME(200) NOT NULL,
	`mobile_verified_at` DATETIME(200) NOT NULL,
	`verified_code` VARCHAR(200) NOT NULL,
	`password` VARCHAR(200) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Roles` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`role_name` VARCHAR(200) NOT NULL UNIQUE,
	`role_slug` VARCHAR(200) NOT NULL UNIQUE,
	`role_description` VARCHAR(200) NOT NULL,
	`role_type` VARCHAR(200) NOT NULL DEFAULT 'admin'
);

CREATE TABLE `user_roles` (
	`user_id` INT NOT NULL,
	`role_id` INT NOT NULL
);

CREATE TABLE `employees` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`emp_id` INT NOT NULL UNIQUE DEFAULT 'which is genrate according to requirement',
	`user_id` INT NOT NULL UNIQUE DEFAULT 'which is genrate according to requirement',
	`designation_id` INT NOT NULL,
	`ec_number` VARCHAR(255) NOT NULL,
	`gender` VARCHAR(20) NOT NULL,
	`id_number` VARCHAR(200) NOT NULL,
	`contract_duration` VARCHAR(200) NOT NULL,
	`basic_salary` DECIMAL NOT NULL,
	`date_of_current_basic` DATETIME NOT NULL,
	`date_of_birth` DATE NOT NULL,
	`start_date` DATE NOT NULL,
	`branch_id` DATE NOT NULL,
	`pension_contribution` DECIMAL NOT NULL,
	`union_membership_id` DECIMAL NOT NULL,
	`amount_payable_to_bomaid_each_year` DECIMAL NOT NULL,
	`currency` VARCHAR(255) NOT NULL,
	`bank_name` VARCHAR(255) NOT NULL,
	`bank_account_number` VARCHAR(255) NOT NULL,
	`bank_holder_name` VARCHAR(255) NOT NULL,
	`ifsc` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `designation` (
	`name` VARCHAR(200) NOT NULL UNIQUE,
	`description` VARCHAR(200) NOT NULL,
	`id` INT(200) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
);

CREATE TABLE `branches` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`branch` VARCHAR(255) NOT NULL,
	`branch_code` VARCHAR(255) NOT NULL UNIQUE,
	`branch_address` VARCHAR(255) NOT NULL UNIQUE,
	`branch_city` VARCHAR(255) NOT NULL UNIQUE,
	`branch_state` VARCHAR(255) NOT NULL UNIQUE,
	`branch_country` VARCHAR(255) NOT NULL UNIQUE,
	`branch_landmark` VARCHAR(255) NOT NULL UNIQUE,
	`status` VARCHAR(255) NOT NULL UNIQUE,
	`description` VARCHAR(255) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `union_memberships` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`amount` DECIMAL NOT NULL,
	`type` VARCHAR(255) NOT NULL DEFAULT 'flat-> percantage',
	`description` VARCHAR(255) NOT NULL DEFAULT 'flat-> percantage',
	`membership_code` VARCHAR(255) NOT NULL DEFAULT 'flat-> percantage',
	PRIMARY KEY (`id`)
);

CREATE TABLE `employee_famailes` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(255) NOT NULL,
	`last_name` VARCHAR(255) NOT NULL,
	`age` INT NOT NULL,
	`relation` VARCHAR(255) NOT NULL DEFAULT 'brother,sister,mother,sister,spouse,son,daughter',
	`is_working` BOOLEAN NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `employee_trainings` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`course_id` INT NOT NULL,
	`enrolled_start_date` DATETIME NOT NULL,
	`enrolled_end_date` DATETIME NOT NULL,
	`training_institute` VARCHAR(255) NOT NULL,
	`is_ completed` BOOLEAN NOT NULL,
	`score_percantage` INT NOT NULL,
	PRIMARY KEY (`id`)
);
CREATE TABLE `courses` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	`duration` VARCHAR(255) NOT NULL,
	`course_category_id` VARCHAR(255) NOT NULL,
	`course_sub_category_id` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `course_categories` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `course_sub_categories` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`category_id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(255) NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
);

CREATE TABLE `emp_bonuses` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`titile` VARCHAR(255) NOT NULL,
	`bonus_amount` DECIMAL NOT NULL,
	`bonus_value` DECIMAL NOT NULL,
	`bonus_value_type` DECIMAL NOT NULL DEFAULT 'flat,percantage',
	`bonus_is_transfer` BOOLEAN NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `loans` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(255) NOT NULL,
	`start_amount` DECIMAL NOT NULL,
	`end_amount` DECIMAL NOT NULL,
	`late_fine_amount` DECIMAL NOT NULL,
	`late_fine_amount_type` VARCHAR(255) NOT NULL DEFAULT 'flat,percantage',
	`no_min_installment` INT NOT NULL,
	`no_max_installment` INT NOT NULL,
	`max_installment_amount` DECIMAL NOT NULL,
	`min_installment_amount` DECIMAL NOT NULL,
	`rate_of_interest` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `emp_loans` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`loan_id` INT NOT NULL,
	`start_date` DATE NOT NULL,
	`end_date` DATE NOT NULL,
	`principle_amount` DECIMAL NOT NULL,
	`maturity_amount` DECIMAL NOT NULL,
	`tenure` INT NOT NULL,
	`sanctioned` INT NOT NULL,
	`sanctioned_amount` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `emp_leaves` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL AUTO_INCREMENT,
	`leave_applies_for` VARCHAR(255) NOT NULL,
	`start_date` DATETIME NOT NULL,
	`end_date` DATETIME NOT NULL,
	`is_approved` BOOLEAN NOT NULL,
	`approved_by` INT NOT NULL,
	`approved_date` DATETIME NOT NULL,
	`is_paid` BOOLEAN NOT NULL,
	`leave_reason` VARCHAR(255) NOT NULL,
	`apply_date` DATETIME NOT NULL,
	`remark` VARCHAR(255) NOT NULL,
	`status` VARCHAR(255) NOT NULL DEFAULT 'pending',
	PRIMARY KEY (`id`)
);

ALTER TABLE `courses` ADD CONSTRAINT `courses_fk0` FOREIGN KEY (`course_category_id`) REFERENCES `course_categories`(`id`);

ALTER TABLE `courses` ADD CONSTRAINT `courses_fk1` FOREIGN KEY (`course_sub_category_id`) REFERENCES `course_sub_categories`(`id`);









ALTER TABLE `user_roles` ADD CONSTRAINT `user_roles_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`);

ALTER TABLE `user_roles` ADD CONSTRAINT `user_roles_fk1` FOREIGN KEY (`role_id`) REFERENCES `Roles`(`id`);

ALTER TABLE `employees` ADD CONSTRAINT `employees_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`);

ALTER TABLE `employees` ADD CONSTRAINT `employees_fk1` FOREIGN KEY (`designation_id`) REFERENCES `designation`(`id`);

ALTER TABLE `employees` ADD CONSTRAINT `employees_fk2` FOREIGN KEY (`branch_id`) REFERENCES `branches`(`id`);

ALTER TABLE `employees` ADD CONSTRAINT `employees_fk3` FOREIGN KEY (`union_membership_id`) REFERENCES `union_memberships`(`id`);

ALTER TABLE `employee_trainings` ADD CONSTRAINT `employee_trainings_fk0` FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`);





CREATE TABLE `employees` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`emp_id` INT NOT NULL UNIQUE DEFAULT 'which is genrate according to requirement',
	`user_id` INT NOT NULL UNIQUE DEFAULT 'which is genrate according to requirement',
	`designation_id` INT NOT NULL,
	`ec_number` VARCHAR(255) NOT NULL,
	`gender` VARCHAR(20) NOT NULL,
	`id_number` VARCHAR(200) NOT NULL,
	`contract_duration` VARCHAR(200) NOT NULL,
	`basic_salary` DECIMAL NOT NULL,
	`date_of_current_basic` DATETIME NOT NULL,
	`date_of_birth` DATE NOT NULL,
	`start_date` DATE NOT NULL,
	`branch_id` DATE NOT NULL,
	`pension_contribution` DECIMAL NOT NULL,
	`union_membership_id` DECIMAL NOT NULL,
	`amount_payable_to_bomaid_each_year` DECIMAL NOT NULL,
	`currency` VARCHAR(255) NOT NULL,
	`bank_name` VARCHAR(255) NOT NULL,
	`bank_account_number` VARCHAR(255) NOT NULL,
	`bank_holder_name` VARCHAR(255) NOT NULL,
	`ifsc` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `permissions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`slug` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `roles_permissions` (
	`role_id` INT NOT NULL,
	`permission_id` INT NOT NULL
);

CREATE TABLE `emp_payscale` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`basic` DECIMAL NOT NULL,
	`hra` DECIMAL NOT NULL,
	`overtime` DECIMAL NOT NULL,
	`arrear` DECIMAL NOT NULL,
	`union_membership` DECIMAL NOT NULL,
	`pf_per` INT NOT NULL,
	`pf_amount` DECIMAL NOT NULL,
	`pension_per` INT NOT NULL,
	`pension_amount` DECIMAL NOT NULL,
	`loans_ deduction` DECIMAL NOT NULL,
	`no_of_working_days` INT NOT NULL,
	`no_of_paid_leaves` INT NOT NULL,
	`shift` VARCHAR(255) NOT NULL,
	`working_hours_start` VARCHAR(255) NOT NULL,
	`working_hours_end` VARCHAR(255) NOT NULL,
	`no_of_payable_days` INT NOT NULL,
	`conveyance` DECIMAL NOT NULL,
	`special` DECIMAL NOT NULL,
	`mobile` DECIMAL NOT NULL,
	`bonus` DECIMAL NOT NULL,
	`transportation` DECIMAL NOT NULL,
	`food` DECIMAL NOT NULL,
	`medical` DECIMAL NOT NULL,
	`gross_earning` DECIMAL NOT NULL,
	`esi_per` INT NOT NULL,
	`esi_amount` DECIMAL NOT NULL,
	`income_tax_deductions` DECIMAL NOT NULL,
	`penalty_deductions` DECIMAL NOT NULL,
	`fixed_deductions` DECIMAL NOT NULL,
	`other_deductions` DECIMAL NOT NULL,
	`gross_earning` DECIMAL NOT NULL,
	`net_take_home` DECIMAL NOT NULL,
	`total_ deduction` DECIMAL NOT NULL,
	`ctc` DECIMAL NOT NULL,
	`total_employer_ contribution` DECIMAL NOT NULL,
	`created_at` DATETIME NOT NULL,
	`created_by` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `emp_salary` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`basic` DECIMAL NOT NULL,
	`hra` DECIMAL NOT NULL,
	`overtime` DECIMAL NOT NULL,
	`arrear` DECIMAL NOT NULL,
	`union_membership` DECIMAL NOT NULL,
	`pf_per` INT NOT NULL,
	`pf_amount` DECIMAL NOT NULL,
	`pension_per` INT NOT NULL,
	`pension_amount` DECIMAL NOT NULL,
	`loans_ deduction` DECIMAL NOT NULL,
	`no_of_working_days` INT NOT NULL,
	`no_of_paid_leaves` INT NOT NULL,
	`shift` VARCHAR(255) NOT NULL,
	`working_hours_start` VARCHAR(255) NOT NULL,
	`working_hours_end` VARCHAR(255) NOT NULL,
	`no_of_payable_days` INT NOT NULL,
	`conveyance` DECIMAL NOT NULL,
	`special` DECIMAL NOT NULL,
	`mobile` DECIMAL NOT NULL,
	`bonus` DECIMAL NOT NULL,
	`transportation` DECIMAL NOT NULL,
	`food` DECIMAL NOT NULL,
	`medical` DECIMAL NOT NULL,
	`gross_earning` DECIMAL NOT NULL,
	`esi_per` INT NOT NULL,
	`esi_amount` DECIMAL NOT NULL,
	`income_tax_deductions` DECIMAL NOT NULL,
	`penalty_deductions` DECIMAL NOT NULL,
	`fixed_deductions` DECIMAL NOT NULL,
	`other_deductions` DECIMAL NOT NULL,
	`gross_earning` DECIMAL NOT NULL,
	`net_take_home` DECIMAL NOT NULL,
	`total_ deduction` DECIMAL NOT NULL,
	`ctc` DECIMAL NOT NULL,
	`total_employer_ contribution` DECIMAL NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `holidays` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL UNIQUE,
	`date` DATE NOT NULL,
	`is_paid` BOOLEAN NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);







ALTER TABLE `roles_permissions` ADD CONSTRAINT `roles_permissions_fk0` FOREIGN KEY (`role_id`) REFERENCES `Roles`(`id`);

ALTER TABLE `roles_permissions` ADD CONSTRAINT `roles_permissions_fk1` FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`);

ALTER TABLE `emp_payscale` ADD CONSTRAINT `emp_payscale_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`);

ALTER TABLE `emp_salary` ADD CONSTRAINT `emp_salary_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`);
















