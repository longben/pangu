create or replace procedure init_coupon(out flag int,in _start int ,in _end int ,in _num int ,in _group char)
begin 
    declare _random  char(6);
    declare _pwd  char(6);
    declare _no char(10);
    declare _count int;

    set _count = 0;

    -- insert list data
	insert into coupon_lists(coupon_start,coupon_end,coupon_group,custom_num,status)
      values(_start,_end,UPPER(_group),_num,0);
    commit;

	-- record list id
	select id INTO @lid FROM coupon_lists 
			  where coupon_start = _start and coupon_end = _end 
					and coupon_group = _group and custom_num = _num and status = 0;

    -- 生成代金券
	while  _start <= _end do
		-- 开始执行更改list状态
		IF _count = 0 THEN 
			update coupon_lists set status = 1 where id = @lid;
		END IF ;
		set _random = rpad(rand(_start) * 1000000,6,'0');
		set _pwd = rpad(_random ^ _num,6,'0');
		set _no = concat(_group,lpad(_start,9,'0'));
		insert into coupons(list_id,coupon_no,coupon_pwd,custom_num,random_num,coupon_group) 
			values(@lid,_no,_pwd,_num,_random,UPPER(_group));
		if mod(_count,10000) = 0 then 
		  commit;
		end if;
        set _start = _start + 1;
		set _count = _count + 1;
    end while;

    -- 生成完毕，更新list状态
	update coupon_lists set status = 2 where id = @lid;

    commit;
end 
