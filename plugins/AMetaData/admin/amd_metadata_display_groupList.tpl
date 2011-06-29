{foreach from=$datas.groups key=name item=data}
  <li id="iGroupId{$data.id}" class="groupItems gcBgPage">
    <img src="{$themeconf.admin_icon_dir}/cat_move.png" class="button drag_button" alt="{'Drag to re-order'|@translate}" title="{'Drag to re-order'|@translate}"/>
    <input type="hidden" id="iGroupName{$data.id}" value="{$data.name}">
    {$data.name}

    <a onclick="deleteGroup('{$data.id}');">
      <img src="{$themeconf.admin_icon_dir}/delete.png"  class="button drag_button" alt="{'g003_click_to_delete_group'|@translate}" title="{'g003_click_to_delete_group'|@translate}"
            style="float:right;"/>
    </a>

    <a onclick="editGroup('{$data.id}');">
      <img src="{$themeconf.admin_icon_dir}/category_edit.png"  class="button drag_button" alt="{'g003_click_to_edit_group'|@translate}" title="{'g003_click_to_edit_group'|@translate}"
            style="float:right;"/>
    </a>

    <a onclick="manageGroup('{$data.id}', '');">
      <img src="{$themeconf.admin_icon_dir}/preferences.png"  class="button drag_button" alt="{'g003_click_to_manage_group'|@translate}" title="{'g003_click_to_manage_group'|@translate}"
            style="float:right;"/>
    </a>


    <div name="fGroupId{$data.id}_content" id="iGroupId{$data.id}_content" style="visibility:hidden;height:0px;" class="groupTags">
      <a onclick="editGroupList('{$data.id}');" class="button editGroupListButton">
      <img src="{$themeconf.admin_icon_dir}/edit_s.png"  class="button drag_button" alt="{'g003_click_to_manage_list'|@translate}" title="{'g003_click_to_manage_list'|@translate}"/>
      </a>
      <ul id="iGroupId{$data.id}_tags" class="tagListOrder g{$data.id}_connectedSortableTags">
      </ul>
    </div>
  </li>
{/foreach}
