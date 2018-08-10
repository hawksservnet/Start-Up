<?php
class Controller_Admin_Event_Status extends Controller_Admin
{

	public function action_index()
	{
		$data['event_statuses'] = Model_Event_Status::find('all');
		$this->template->title = "Event_statuses";
		$this->template->content = View::forge('admin/event/status/index', $data);

	}

	public function action_view($id = null)
	{
		$data['event_status'] = Model_Event_Status::find($id);

		$this->template->title = "Event_status";
		$this->template->content = View::forge('admin/event/status/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Event_Status::validate('create');

			if ($val->run())
			{
				$event_status = Model_Event_Status::forge(array(
					'name' => Input::post('name'),
				));

				if ($event_status and $event_status->save())
				{
					Session::set_flash('success', e('Added event_status #'.$event_status->id.'.'));

					Response::redirect('admin/event/status');
				}

				else
				{
					Session::set_flash('error', e('Could not save event_status.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Event_Statuses";
		$this->template->content = View::forge('admin/event/status/create');

	}

	public function action_edit($id = null)
	{
		$event_status = Model_Event_Status::find($id);
		$val = Model_Event_Status::validate('edit');

		if ($val->run())
		{
			$event_status->name = Input::post('name');

			if ($event_status->save())
			{
				Session::set_flash('success', e('Updated event_status #' . $id));

				Response::redirect('admin/event/status');
			}

			else
			{
				Session::set_flash('error', e('Could not update event_status #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$event_status->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('event_status', $event_status, false);
		}

		$this->template->title = "Event_statuses";
		$this->template->content = View::forge('admin/event/status/edit');

	}

	public function action_delete($id = null)
	{
		if ($event_status = Model_Event_Status::find($id))
		{
			$event_status->delete();

			Session::set_flash('success', e('Deleted event_status #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete event_status #'.$id));
		}

		Response::redirect('admin/event/status');

	}

}
