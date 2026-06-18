<style>
.setting-sidebar {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    padding: 15px;
    background: rgba(17, 24, 39, 0.5);
    border-radius: 15px;
    border: 1px solid rgba(255,255,255,0.03);
    margin-bottom: 25px !important;
}
.setting-sidebar .nav-item {
    margin: 0;
}
.setting-sidebar .nav-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #1e1e2d;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 12px;
    padding: 12px 5px;
    width: 90px;
    height: 85px;
    color: #a2a3b7;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
}
.setting-sidebar .nav-link:hover {
    background: #27273b;
    color: #ffffff;
    border-color: rgba(255,255,255,0.1);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.setting-sidebar .nav-link.active {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
    color: #ffffff !important;
    border-color: transparent !important;
    box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3) !important;
    transform: translateY(-2px);
}
.setting-sidebar .nav-link .icon {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0 !important;
    margin-bottom: 8px;
}
/* Tweaking the inner white logo box */
.setting-sidebar .nav-link .icon > div {
    width: 45px !important;
    height: 25px !important;
    border-radius: 4px !important;
    padding: 2px !important;
    border: none !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
}
</style>

<ul class="nav mb-3 setting-sidebar" role="tablist">
<?php
  $xhtml = '';
  $form_items_payment = [
    'other' => 'Payment Settings',
  ];
    if (!empty($items_payment)) {
      foreach ($items_payment as $item) {
        $link = user_url('user-settings/' . $item->type);
        $class_active = ($item->type == $tab ) ? 'active' : '';
        $logo = show_item_transaction_type($item->type);
        $xhtml .= sprintf(
          '<li class="nav-item"><a href="%s" class="nav-link %s"><span class="icon mr-3">%s</span>%s</a></li>', $link, $class_active, $logo, $item->name
        );
      }
    }
  echo $xhtml;
?>
</ul>
