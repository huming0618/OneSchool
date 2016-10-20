DROP VIEW `viewdonations` ;
CREATE VIEW `viewdonations` AS
select 
    donations.id, 
    donations.student_id, 
	donations.donator_id,
	donations.school_id,
	donations.status, 
	donations.brief, 
	school.name, 
	schedule.grade, 
	schedule.semester, 
	schedule.startdate as "semester_start" , 
	schedule.enddate as "semester_end", 
	student.name  as "student", 
	student_class,
	donator.name  as "donator" 
from donations
	left join users as student on donations.student_id = student.id
	left join users as donator on donations.donator_id = donator.id
	left join schools as school on donations.school_id = school.id
	left join school_schedules as schedule on donations.schoolsch_id = schedule.id
	
	