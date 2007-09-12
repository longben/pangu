CREATE PROCEDURE `export_coupon`(out flag int,in _id int)
begin

	declare _filename  varchar(50);

	-- coupon list data
	select id,coupon_group,coupon_start,coupon_end INTO @id,@coupon_group,@coupon_start,@coupon_end FROM coupon_lists
			  where id = _id;

	-- 文件名称：组团编号_开始号码_结束号码_日期_批次
	-- concat('d:/pg_export_files/',@coupon_group,'_',@coupon_start,'_',@coupon_end,'_',CURDATE(),'_',@id,'.csv');
	-- concat('d:/pg_export_files/',concat(@coupon_group,concat('_',concat(@coupon_start,concat('_',concat(@coupon_end,concat('_',concat(CURDATE(),concat('_',concat(@id,'.csv'))))))))));

	select concat(coupon_no,concat(',',coupon_pwd)) from coupons where list_id =  _id ORDER BY coupon_no into outfile 'd:/pg_export_files/export.csv ';


    -- 导出完毕，更新list状态
	update coupon_lists set status = 3 where id = @id;

    commit;
end