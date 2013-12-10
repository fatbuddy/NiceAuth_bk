<?php
/**
 * User List View for NiceAuth Plugin
 *
 * NiceAuth : User Authentication and Authorization Plugin for CakePHP
 * Copyright 2011, R.S.Martin (http://rsmartin.me)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @author RSMartin
 * @copyright Copyright (c) 2011, RSMartin (http://rsmartin.me)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
?>
<h2>User List</h2>

<table>
<tr>
		<th><?php echo $this->Paginator->sort('username');?></th>
		<th><?php echo $this->Paginator->sort('email');?></th>
		<th><?php echo $this->Paginator->sort('group_id');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th class="actions" colspan="3"><?php echo __('Actions');?></th>
</tr>

<?php
foreach($users as $user) {
	echo "<tr>";
		echo "<td>".$user['User']['username']."</td>";
		echo "<td>".$user['User']['email']."</td>";
		echo "<td>".$groups[$user['User']['group_id']]."</td>";
		echo "<td>".$user['User']['created']."</td>";
		echo "<td>".$this->Html->link('Edit', '/dashboard/user_edit/'.$user['User']['id'])."</td>";
		echo "<td>".$this->Html->link('Permissions', '/dashboard/user_permissions/'.$user['User']['id'])."</td>";
		if ($user['User']['id'] != 1) {
			echo "<td>".$this->Html->link('Delete', '/dashboard/user_delete/'.$user['User']['id'], array(), 'Are you sure you want to delete this user?')."</td></tr>";
			}
	echo "</tr>";
	}
?>
</table>

<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	</p>

<div class="paging">
<?php
	echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
