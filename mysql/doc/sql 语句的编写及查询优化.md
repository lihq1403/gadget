#### 关联查询语句介绍
> 关联查询一共有六种方式，分别是：交叉连接（cross join）、内连接（inner join）、外连接（left join / right join）、联合查询（union 与 union all）、全连接（full join）

##### 交叉连接
	select * from A,B,(C) 或者
	select * from A cross join B (cross join c)
	没有任何关联条件，结果时笛卡儿积，结果集会很大，没有意义，很少使用

##### 内连接
	select * from A,B where A.id = B.id z或者
	select * from A inner join B on A.id = b.id
	多表中同时符合某种条件的数据记录的集合
	
	内连接分为三类
		- 等值连接：on a.id = b.id
		- 不等值连接：on a.id > b.id
		- 自连接：select * from a t1 inner join a t2 on t1.id = t2.id

##### 外连接
	- 左外连接：left join ,以左表为主，先查询出左表，按照on后的关联条件匹配右表，没有匹配到的用null填充。
	- 右外连接：right join ,以右表为主，先查询出右表，按照on后的关联条件匹配左表，没有匹配到的用null填充。

#### 经典题型分析
#### 表结构
- 学生表student(id,name)
- 课程表course(id,name)
- 学生课程表student_course(sid,cid,score)

#### 创建表的sql代码
```
//创建student表，并插入测试数据
create table student(
id int unsigned primary key auto_increment,
name char(10) not null
);
insert into student(name) values('小明'),('小红');
//创建course表，并插入测试数据
create table course(
id int unsigned primary key auto_increment,
name char(20) not null
);
insert into course(name) values('PHP'),('JAVA');
//创建student_course表，并插入测试数据
create table student_course(
sid int unsigned,
cid int unsigned,
score int unsigned not null,
foreign key (sid) references student(id),
foreign key (cid) references course(id),
primary key(sid, cid)
);
insert into student_course values(1,1,80),(1,2,90),(2,1,90),(2,2,70);
```

#### 问题
1.查询student表中重名的学生，结果包含id和name，按name升序
```
select id,name
from student
where name in (
select name from student group by name having(count(*) > 1)
) order by name ASC;
```
> 分析：因为这里要查询重名的学生，我们想到了用子查询 IN；通过name count（*） 查出重名学生名字。这里我们要注意的是where 与 having的使用场景。
	- Where 是一个约束声明，使用Where约束来自数据库的数据，Where是在结果返回之前起作用的，Where中不能使用聚合函数
	- Having是一个过滤声明，是在查询返回结果集以后对查询结果进行的过滤操作，在Having中可以使用聚合函数。在查询过程中聚合语句(sum,min,max,avg,count)要比having子句优先执行。而where子句在查询过程中执行优先级高于聚合语句。

2. 在student_course表中查询平均分不及格的学生，列出学生id和平均分
```
select sid,avg(score) as avg_score
from student_course
group by sid having(avg_score<60);
```
> 分析： group by和having 使用的考察

3. 在student_course表中查询每门课成绩都不低于80的学生id
```
select distinct sid
from student_course
where sid not in (
select sid from student_course
where score < 80);
```
> 分析： 用到反向思想，使用not in 找出 小于80分的所有sid。

4. 查询每个学生的总成绩，结果列出学生姓名和总成绩。
```
select name,sum(score)
from student left join student_course
on student.id=student_course.sid
group by sid;
```
> 分析：此题使用了左外连接。确保了每个学生都能被查出来。

5. 总成绩最高的学生，结果列出学生id和总成绩 。
```
select sid,sum(score) as sum_score
from student_course group by sid
order by sum_score desc limit 1;
```
> 分析：使用聚合函数，查出每个学生的总分。然后对总分进行降序，取第一条数据。

6. 在student_course表查询各科成绩最高的学生，结果列出学生id、课程id和对应的成绩
```
select * from student_course as x where score>=
(select max(score) from student_course as y where cid=x.cid);
```

