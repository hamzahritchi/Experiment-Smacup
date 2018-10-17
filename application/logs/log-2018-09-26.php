<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-26 17:44:43 --> 404 Page Not Found: Robotstxt/index
ERROR - 2018-09-26 19:17:37 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:37 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:37 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:37 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:37 --> Query error: No such file or directory - Invalid query: SELECT `p`.`peserta_id`, `p`.`peserta_dibuat`, `p`.`peserta_status`, `peserta_email`, `peserta_hp`, `peserta_hadiah`, `peserta_isp`, `peserta_ip`, `peserta_lokasi`, `peserta_kota`, `peserta_browser`, `peserta_pengalaman`, `peserta_navigasi`, `peserta_panduan`, (count(`aktivitas_url`)) as `peserta_aktivitas`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, (karakteristik_1 + karakteristik_2 + karakteristik_3 + karakteristik_4) as karakteristik_total, `karakteristik_text2`, `peserta_urutan`, `case1_final`, (UNIX_TIMESTAMP(case1_timefinish) - UNIX_TIMESTAMP(case1_timestart)) as case1_waktu, `case2_final`, (UNIX_TIMESTAMP(case2_timefinish) - UNIX_TIMESTAMP(case2_timestart)) as case2_waktu, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
FROM `eksperimen_peserta` `p`
JOIN `eksperimen_responden` `r` ON `r`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_aktivitas` `a` ON `a`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_karakteristik` `k` ON `k`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case1` `c1` ON `c1`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case2` `c2` ON `c2`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_kesulitan` `ks` ON `ks`.`peserta_id`=`p`.`peserta_id`
GROUP BY `p`.`peserta_id`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, `karakteristik_total`, `karakteristik_text2`, `case1_final`, `case1_waktu`, `case2_final`, `case2_waktu`, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
ORDER BY `peserta_dibuat` ASC
ERROR - 2018-09-26 19:17:37 --> Severity: Error --> Call to a member function result_array() on boolean /home/risetsistem/public_html/application/controllers/Hasil.php 157
ERROR - 2018-09-26 19:17:40 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:40 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:40 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:40 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:40 --> Query error: No such file or directory - Invalid query: SELECT `p`.`peserta_id`, `p`.`peserta_dibuat`, `p`.`peserta_status`, `peserta_email`, `peserta_hp`, `peserta_hadiah`, `peserta_isp`, `peserta_ip`, `peserta_lokasi`, `peserta_kota`, `peserta_browser`, `peserta_pengalaman`, `peserta_navigasi`, `peserta_panduan`, (count(`aktivitas_url`)) as `peserta_aktivitas`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, (karakteristik_1 + karakteristik_2 + karakteristik_3 + karakteristik_4) as karakteristik_total, `karakteristik_text2`, `peserta_urutan`, `case1_final`, (UNIX_TIMESTAMP(case1_timefinish) - UNIX_TIMESTAMP(case1_timestart)) as case1_waktu, `case2_final`, (UNIX_TIMESTAMP(case2_timefinish) - UNIX_TIMESTAMP(case2_timestart)) as case2_waktu, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
FROM `eksperimen_peserta` `p`
JOIN `eksperimen_responden` `r` ON `r`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_aktivitas` `a` ON `a`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_karakteristik` `k` ON `k`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case1` `c1` ON `c1`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case2` `c2` ON `c2`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_kesulitan` `ks` ON `ks`.`peserta_id`=`p`.`peserta_id`
GROUP BY `p`.`peserta_id`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, `karakteristik_total`, `karakteristik_text2`, `case1_final`, `case1_waktu`, `case2_final`, `case2_waktu`, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
ORDER BY `peserta_dibuat` ASC
ERROR - 2018-09-26 19:17:40 --> Severity: Error --> Call to a member function result_array() on boolean /home/risetsistem/public_html/application/controllers/Hasil.php 157
ERROR - 2018-09-26 19:17:42 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:42 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:42 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:42 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:42 --> Query error: No such file or directory - Invalid query: SELECT `p`.`peserta_id`, `p`.`peserta_dibuat`, `p`.`peserta_status`, `peserta_email`, `peserta_hp`, `peserta_hadiah`, `peserta_isp`, `peserta_ip`, `peserta_lokasi`, `peserta_kota`, `peserta_browser`, `peserta_pengalaman`, `peserta_navigasi`, `peserta_panduan`, (count(`aktivitas_url`)) as `peserta_aktivitas`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, (karakteristik_1 + karakteristik_2 + karakteristik_3 + karakteristik_4) as karakteristik_total, `karakteristik_text2`, `peserta_urutan`, `case1_final`, (UNIX_TIMESTAMP(case1_timefinish) - UNIX_TIMESTAMP(case1_timestart)) as case1_waktu, `case2_final`, (UNIX_TIMESTAMP(case2_timefinish) - UNIX_TIMESTAMP(case2_timestart)) as case2_waktu, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
FROM `eksperimen_peserta` `p`
JOIN `eksperimen_responden` `r` ON `r`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_aktivitas` `a` ON `a`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_karakteristik` `k` ON `k`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case1` `c1` ON `c1`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case2` `c2` ON `c2`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_kesulitan` `ks` ON `ks`.`peserta_id`=`p`.`peserta_id`
GROUP BY `p`.`peserta_id`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, `karakteristik_total`, `karakteristik_text2`, `case1_final`, `case1_waktu`, `case2_final`, `case2_waktu`, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
ORDER BY `peserta_dibuat` ASC
ERROR - 2018-09-26 19:17:42 --> Severity: Error --> Call to a member function result_array() on boolean /home/risetsistem/public_html/application/controllers/Hasil.php 157
ERROR - 2018-09-26 19:17:45 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:45 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:45 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No such file or directory /home/risetsistem/public_html/system/database/drivers/mysqli/mysqli_driver.php 201
ERROR - 2018-09-26 19:17:45 --> Unable to connect to the database
ERROR - 2018-09-26 19:17:45 --> Query error: No such file or directory - Invalid query: SELECT `p`.`peserta_id`, `p`.`peserta_dibuat`, `p`.`peserta_status`, `peserta_email`, `peserta_hp`, `peserta_hadiah`, `peserta_isp`, `peserta_ip`, `peserta_lokasi`, `peserta_kota`, `peserta_browser`, `peserta_pengalaman`, `peserta_navigasi`, `peserta_panduan`, (count(`aktivitas_url`)) as `peserta_aktivitas`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, (karakteristik_1 + karakteristik_2 + karakteristik_3 + karakteristik_4) as karakteristik_total, `karakteristik_text2`, `peserta_urutan`, `case1_final`, (UNIX_TIMESTAMP(case1_timefinish) - UNIX_TIMESTAMP(case1_timestart)) as case1_waktu, `case2_final`, (UNIX_TIMESTAMP(case2_timefinish) - UNIX_TIMESTAMP(case2_timestart)) as case2_waktu, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
FROM `eksperimen_peserta` `p`
JOIN `eksperimen_responden` `r` ON `r`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_aktivitas` `a` ON `a`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_karakteristik` `k` ON `k`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case1` `c1` ON `c1`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_case2` `c2` ON `c2`.`peserta_id`=`p`.`peserta_id`
JOIN `eksperimen_kesulitan` `ks` ON `ks`.`peserta_id`=`p`.`peserta_id`
GROUP BY `p`.`peserta_id`, `responden_jk`, `responden_usia`, `responden_pendidikan`, `responden_bidangusaha`, `responden_penghasilan`, `responden_karyawan`, `karakteristik_total`, `karakteristik_text2`, `case1_final`, `case1_waktu`, `case2_final`, `case2_waktu`, `kesulitan_1`, `kesulitan_2`, `kesulitan_3`, `kesulitan_4`, `kesulitan_5`, `kesulitan_preferensi`
ORDER BY `peserta_dibuat` ASC
ERROR - 2018-09-26 19:17:45 --> Severity: Error --> Call to a member function result_array() on boolean /home/risetsistem/public_html/application/controllers/Hasil.php 157
