create procedure init_coupon(out flag int,in _start int ,in _end int ,in _num int ,in _group char)
begin 
    declare _random  char(6);
    declare _pwd  char(6);
    declare _no char(10);
    declare _count int;
    set _count = 0;
    insert into coupon_lists(coupon_start,coupon_end,coupon_group,custom_num)
      values(_start,_end,_group,_num);
    while  _start <= _end do
        set _random = rpad(rand(_start) * 1000000,6,'0');
	set _pwd = rpad(_random ^ _num,6,'0');
	set _no = concat(_group,lpad(_start,9,'0'));
	insert into coupons(coupon_no,coupon_pwd,custom_num,random_num,coupon_group) 
	    values(_no,_pwd,_num,_random,_group);
	if mod(_count,10000) = 0 then 
	  commit;
	end if;
        set _start = _start + 1;
	set _count = _count + 1;
    end while;
end 