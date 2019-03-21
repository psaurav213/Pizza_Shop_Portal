create table Shop(pan_no varchar(10),name varchar(25),streetname varchar(10),country varchar(8),pin_code varchar(6),constraint pk1 primary key(pan_no));
insert into shop values('ARLPA0061H','Pizza Hut','Vellore','India',632014);


create table employee(emp_id int AUTO_INCREMENT,name varchar(25),join_date date,streetname varchar(15),city varchar(10),constraint pk2 primary key(emp_id));
insert into employee (name,join_date,streetname,city)values('Saurav Patil','2014-01-13','Jalgaon','Maharashtra');
insert into employee (name,join_date,streetname,city)values('Simant Shrestha','2015-01-18','Adarshnagar','Surkhet');
insert into employee (name,join_date,streetname,city)values('Suman Mondal','2016-01-13','Gandhinagar','Kolkata');
insert into employee (name,join_date,streetname,city)values('Abhineet Chaudhary','2014-01-13','Murli','Birgunj');


create table emp_mail(mail varchar(30),emp_id int,constraint pk3 primary key(mail));
insert into emp_mail values('sauravsunil.patil2016@vitstudent.ac.in',1);
insert into emp_mail values('Patilsaurav21@yahoo.com',1);
insert into emp_mail values('simant@gmail.com',2);
insert into emp_mail values('abhineet.adm09@gmail.com',4);
insert into emp_mail values('abhineetnuts@gmail.com',4);
insert into emp_mail values('mithu_mondal@gmail.com',3);


create table emp_phone(phone numeric(30),emp_id int,constraint pk4 primary key(phone));
insert into emp_phone values(9087770819,1);
insert into emp_phone values(7530007443,2);
insert into emp_phone values(9832432232,2);
insert into emp_phone values(7530452411,3);
insert into emp_phone values(8743009823,4);
insert into emp_phone values(9012317449,4);

create table authentication(emp_id varchar(5),password varchar(10),constraint pk5 primary key(emp_id));
insert into authentication values(1,'Saurav');
insert into authentication values(2,'motog');
insert into authentication values(3,'bond007');
insert into authentication values(4,'tes98la');

create table customer(cust_id int AUTO_INCREMENT,name varchar(20),hno numeric(5),streetname varchar(15),city varchar(10),constraint pk6 primary key(cust_id));
insert into customer (name,streetname,city)values('Vaibhav','Hoyota','Banglore');
insert into customer (name,streetname,city)values('Arin','Ring Road','Shilong');
insert into customer (name,streetname,city)values('Priyanshu','Prasad Marg','Patna');
insert into customer (name,streetname,city)values('Shivam','Thane','Maharashtra');
insert into customer (name,streetname,city)values('Ashish','Gandhi Road','Dehradun');

create table house(cust_id int,hno int);
insert into house values(1,21);
insert into house values(2,12);
insert into house values(3,22);
insert into house values(4,43);
insert into house values(5,101);

create table cust_mail(mail varchar(30),cust_id int,constraint pk7 primary key(mail));
insert into cust_mail values('vaibhow@gmail.com',1);
insert into cust_mail values('rhitom@gmail.com',2);
insert into cust_mail values('arin@gmail.com',2);
insert into cust_mail values('priyansh@gmail.com',3);
insert into cust_mail values('shiv@gmail.com',4);
insert into cust_mail values('ashish_cool@gmail.com',5);

create table cust_phone(phone numeric(30),cust_id int,constraint pk8 primary key(phone));
insert into cust_phone values(7530534534,1);
insert into cust_phone values(6423724821,2);
insert into cust_phone values(9876723655,3);
insert into cust_phone values(8273452142,4);
insert into cust_phone values(9777678142,5);
insert into cust_phone values(7530218421,5);

create table order_details(ord_id int AUTO_INCREMENT,dt_ord date,constraint pk9 primary key(ord_id));
insert into order_details (dt_ord)values('2014-12-23');
insert into order_details (dt_ord)values('2014-12-23');
insert into order_details (dt_ord)values('2015-01-01');
insert into order_details (dt_ord)values('2015-02-01');
insert into order_details (dt_ord)values('2015-03-01');

create table order_qty(ord_id int,flvr_id varchar(4),cust_id varchar(5),qty numeric(3),constraint pk10 primary key(ord_id,flvr_id,cust_id));
insert into order_qty values(1,'CC01',1,1);
insert into order_qty values(1,'CB12',1,2);
insert into order_qty values(2,'PS77',2,3);
insert into order_qty values(2,'JP31',2,2);
insert into order_qty values(3,'PS77',3,5);
insert into order_qty values(5,'CC01',3,2);

create table order_asc(ord_id varchar(8),flvr_id varchar(4),cust_id varchar(5),constraint pk16 primary key(ord_id,flvr_id,cust_id));
insert into order_asc values(1,'CC01',1);
insert into order_asc values(1,'CB12',1);
insert into order_asc values(2,'PS77',2);
insert into order_asc values(2,'JP31',2);
insert into order_asc values(3,'PS77',3);
insert into order_asc values(5,'CC01',4);

create table Pizza(flvr_id varchar(4),Pizza_name varchar(20),constraint pk11 primary key(flvr_id));
insert into Pizza values('CC01','Margherita');
insert into Pizza values('CB12','Double-Cheese-Margherita');
insert into Pizza values('NP01','Farm-House');
insert into Pizza values('SB45','Peppy-Paneer');
insert into Pizza values('PS77','Mexican-Green Wave');
insert into Pizza values('JP31','Delux-Vegie');

create table Pizza_details(flvr_id varchar(4),calorie numeric(3),cost numeric(4),constraint pk12 primary key(flvr_id));
insert into Pizza_details values('CC01',25,91);
insert into Pizza_details values('CB12',255,101);
insert into Pizza_details values('NP01',35,21);
insert into Pizza_details values('SB45',96,71);
insert into Pizza_details values('PS77',113,91);
insert into Pizza_details values('JP31',67,21);

create table ingredient(pid varchar(4),pname varchar(15),constraint pk13 primary key(pid));
insert into ingredient values('KT01','Olive oil');
insert into ingredient values('KT02','Cornmeal');
insert into ingredient values('KT03','mozzarella Cheese');
insert into ingredient values('KT04','Parmesan Cheese');
insert into ingredient values('KT05','Feta Cheese');
insert into ingredient values('KT06','Mushroom');
insert into ingredient values('KT07','Bell Peppers');
insert into ingredient values('KT08','Onions');
insert into ingredient values('KT09','Pepperoni');
insert into ingredient values('KT10','Pesto');
insert into ingredient values('KT11','Paneer');

create table ingredient_detail(pid varchar(4),stock numeric(3),constraint pk14 primary key(pid));
insert into ingredient_detail values('KT01',10);
insert into ingredient_detail values('KT02',0);
insert into ingredient_detail values('KT03',71);
insert into ingredient_detail values('KT04',32);
insert into ingredient_detail values('KT05',4);
insert into ingredient_detail values('KT06',10);

create table reqd(pid varchar(4),flvr_id varchar(4),qty_reqd numeric(3),constraint pk15 primary key(pid,flvr_id));
insert into reqd values('KT01','CC01',3);
insert into reqd values('KT06','CB12',2);
insert into reqd values('KT05','JP31',1);
insert into reqd values('KT05','NP01',1);
insert into reqd values('KT02','SB45',2);
insert into reqd values('KT03','PS77',3);

create table feedback(fid int NOT NULL AUTO_INCREMENT,cust_id int,constraint pk17 primary key(fid));
insert into feedback (cust_id) values(1);
insert into feedback (cust_id) values(2);
insert into feedback (cust_id) values(3);
insert into feedback (cust_id) values(4);
insert into feedback (cust_id) values(1);

create table comments(fid int NOT NULL,comment varchar(100),rank numeric(4),constraint pk18 primary key(fid));
insert into comments values(1,'awesome',5);
insert into comments values(2,'a bit more Pepperoni needed',1);
insert into comments values(3,'best Pizza we ever had',5);
insert into comments values(4,'Americas finest',4);
insert into comments values(5,'improved',3);

alter table emp_phone add constraint fk1 foreign key(emp_id) references employee(emp_id);
alter table emp_mail add constraint fk2 foreign key(emp_id) references employee(emp_id);
alter table cust_phone add constraint fk3 foreign key(cust_id) references customer(cust_id);
alter table cust_mail add constraint fk4 foreign key(cust_id) references customer(cust_id);
alter table order_qty add constraint fk5 foreign key(ord_id) references order_details(ord_id);
alter table order_qty add constraint fk6 foreign key(flvr_id) references Pizza(flvr_id);
alter table Pizza_details add constraint fk7 foreign key(flvr_id) references Pizza(flvr_id);
alter table ingredient_detail add constraint fk8 foreign key(pid) references ingredient(pid);
alter table reqd add constraint fk9 foreign key(pid) references ingredient(pid);
alter table reqd add constraint fk10 foreign key(flvr_id) references Pizza(flvr_id);
alter table feedback add constraint fk11 foreign key(cust_id) references customer(cust_id);
alter table comments add constraint fk12 foreign key(fid) references feedback(fid);
Alter table Pizza_details add constraint ck1 check(cost IS NOT NULL);
Alter table ingredient_detail add constraint ck2 check(stock IS NOT NULL);


create table order_status(ord_id int primary key,inlock int);
insert into order_status values(1,0);
insert into order_status values(2,0);
insert into order_status values(3,0);
insert into order_status values(4,0);
insert into order_status values(24,1);


create table ord_type(ord_id int primary key,type varchar(15));
insert into ord_type values(1,'takeaway');
insert into ord_type values(2,'home-delivery');
insert into ord_type values(3,'takeaway');
insert into ord_type values(4,'home-delivery');
insert into ord_type values(5,'takeaway');

create table ord_num(ord_id int primary key,phone varchar(15));	
