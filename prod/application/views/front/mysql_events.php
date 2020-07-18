<?php 
/******* Convert Open Contest To Judging Contest ***********/
DELIMITER |

CREATE EVENT event_judging
    ON SCHEDULE EVERY 1 MINUTE
	STARTS CURRENT_TIMESTAMP 
    DO
      BEGIN
		DECLARE contest_id INT(11);
		DECLARE done INT default 0;
		DECLARE cur_check CURSOR FOR SELECT  `id` FROM `contest` WHERE `status`='open' and date(now())= date(`close_date`) and hour(now())= hour(`close_date`) and minute(now())= minute(`close_date`);
		DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
		
		open cur_check;
			contest_loop: LOOP
				fetch cur_check into contest_id;
				
				IF done = 1 THEN 
				LEAVE contest_loop;
				END IF;
				
				UPDATE `contest` SET  `status`='judging' WHERE `id`=contest_id;
				
			end LOOP contest_loop;
		close cur_check;
		
      END |

DELIMITER ;
?>
