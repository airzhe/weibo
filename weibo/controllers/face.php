<?php 
class face extends Front_Controller{
	/**
	 * 输出表情数据
	 */
	public function index(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$face_url=base_url('assets/images/hotFace');
		$faces=array ( '让红包飞' => 'hongbaofei2014_thumb', '求红包' => 'lxhhongbao2014_thumb', '青啤鸿运当头' => 'hongyun_thumb', '笑哈哈' => 'lxhwahaha_thumb', '得意地笑' => 'lxhdeyidixiao_thumb', 'lt火车票' => 'lttickets_thumb', 'moc转发' => 'moczhuanfa_thumb', 'ali哇' => 'aliwanew_thumb', 'bm可爱' => 'bmkeai_thumb', 'xkl转圈' => 'xklzhuanquan_thumb', 'ppb鼓掌' => 'ppbguzhang_thumb', 'din推撞' => 'dintuizhuang_thumb', '草泥马' => 'shenshou_thumb', '神马' => 'horse2_thumb', '浮云' => 'fuyun_thumb', '给力' => 'geili_thumb', '围观' => 'wg_thumb', '威武' => 'vw_thumb', '熊猫' => 'panda_thumb', '兔子' => 'rabbit_thumb', '奥特曼' => 'otm_thumb', '囧' => 'j_thumb', '互粉' => 'hufen_thumb', '礼物' => 'liwu_thumb', '呵呵' => 'smilea_thumb', '嘻嘻' => 'tootha_thumb', '哈哈' => 'laugh', '可爱' => 'tza_thumb', '可怜' => 'kl_thumb', '挖鼻屎' => 'kbsa_thumb', '吃惊' => 'cj_thumb', '害羞' => 'shamea_thumb', '挤眼' => 'zy_thumb', '闭嘴' => 'bz_thumb', '鄙视' => 'bs2_thumb', '爱你' => 'lovea_thumb', '泪' => 'sada_thumb', '偷笑' => 'heia_thumb', '亲亲' => 'qq_thumb', '生病' => 'sb_thumb', '太开心' => 'mb_thumb', '懒得理你' => 'ldln_thumb', '右哼哼' => 'yhh_thumb', '左哼哼' => 'zhh_thumb', '嘘' => 'x_thumb', '衰' => 'cry', '委屈' => 'wq_thumb', '吐' => 't_thumb', '打哈欠' => 'k_thumb', '抱抱' => 'bba_thumb', '怒' => 'angrya_thumb', '疑问' => 'yw_thumb', '馋嘴' => 'cza_thumb', '拜拜' => '88_thumb', '思考' => 'sk_thumb', '汗' => 'sweata_thumb', '困' => 'sleepya_thumb', '睡觉' => 'sleepa_thumb', '钱' => 'money_thumb', '失望' => 'sw_thumb', '酷' => 'cool_thumb', '花心' => 'hsa_thumb', '哼' => 'hatea_thumb', '鼓掌' => 'gza_thumb', '晕' => 'dizzya_thumb', '悲伤' => 'bs_thumb', '抓狂' => 'crazya_thumb', '黑线' => 'h_thumb', '阴险' => 'yx_thumb', '怒骂' => 'nm_thumb', '心' => 'hearta_thumb', '伤心' => 'unheart', '猪头' => 'pig', 'ok' => 'ok_thumb', '耶' => 'ye_thumb', 'good' => 'good_thumb', '不要' => 'no_thumb', '赞' => 'z2_thumb', '来' => 'come_thumb', '弱' => 'sad_thumb', '蜡烛' => 'lazu_thumb', '钟' => 'clock_thumb', '话筒' => 'm_thumb', '蛋糕' => 'cake' );
		$face_list='';
		foreach ($faces as $key => $value) {
			$face_list.="<li><img src='{$face_url}/{$value}.gif' alt='{$key}' title='{$key}'>";
		}
		die($face_list);
	}
}
