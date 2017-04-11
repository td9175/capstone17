-- insert into UserAccount (email, hash_pass, first_name, last_name, is_enabled, is_admin) values ("umbCapstone17@gmail.com", "$ecureP@ssword", "UMB", "Capstone17", 1, 1);
insert into UserAccount (email, hash_pass, first_name, last_name, is_enabled, is_admin) values ("umbCapstone17@gmail.com", "password", "UMB", "Capstone17", 1, 1);

insert into HealthAccount (account_number, account_type, email) values ("00000001", "HSA", "umbCapstone17@gmail.com");
insert into HealthAccount (account_number, account_type, email) values ("00000002", "FSA", "umbCapstone17@gmail.com");

insert into AccountTransaction (amount, account_number) values (5500, 00000001);
insert into AccountTransaction (amount, account_number) values (1900, 00000001);

insert into Receipt (email, image) values ("umbCapstone17@gmail.com", "path/to/image");

insert into Reimbursement (receipt_id, amount, account_number) values (2, 2500, 00000001);
insert into Reimbursement (receipt_id, amount, account_number) values (2, 1400, 00000001);
