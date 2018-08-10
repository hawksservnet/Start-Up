<?php
class Controller_Admin_Tag extends Controller_Admin
{

	public function action_index()
	{
		$query = Model_Tag::query();
		$query = Model_Tag::setSearchCondition($query, Input::get('keyword'));
		$data['tags'] = $query->get();
		$this->template->title = "Tags";
		$this->template->content = View::forge('admin/tag/index', $data);

	}

	public function action_view($id = null)
	{
		$data['tag'] = Model_Tag::find($id);

		$this->template->title = "Tag";
		$this->template->content = View::forge('admin/tag/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Tag::validate('create');

			if ($val->run())
			{
				$tag = Model_Tag::forge(array(
					'name' => Input::post('name'),
				));

				Session::set('Tag.input.add', $tag->to_array());
				Response::redirect('admin/tag/create_confirm');
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Tags";
		$this->template->content = View::forge('admin/tag/create');

	}
	public function action_create_confirm()
	{
		$tag = Model_Tag::forge(Session::get('Tag.input.add'));
		if (Input::method() == 'POST')
		{
			if ($tag->save())
			{
				Session::set_flash('success', 'タグを登録しました');
				Response::redirect('admin/tag');
			}
			else
			{
				Session::set_flash('error', 'タグを登録できませんでした');
			}
		}
		$data['tag'] = $tag;
		$this->template->title = "Tag";
		$this->template->content = View::forge('admin/tag/edit_confirm', $data);
	}

	public function action_edit($id = null)
	{
		$tag = Model_Tag::find($id);
		$val = Model_Tag::validate('edit', $id);
		if (Input::method() == 'POST')
		{
			if ($val->run())
			{
				$tag->name = Input::post('name');
				Session::set('Tag.input.'. $id, $tag->to_array());
				Response::redirect('admin/tag/edit_confirm/'. $id);
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->set_global('tag', $tag, false);
		$this->template->title = "Tags";
		$this->template->content = View::forge('admin/tag/edit');
	}
	public function action_edit_confirm($id)
	{
		$tag = Model_Tag::find($id);
		$tag->set(Session::get('Tag.input.'. $id));
		if (Input::method() == 'POST')
		{
			if ($tag->save())
			{
				Session::set_flash('success', 'タグを登録しました');
				Response::redirect('admin/tag');
			}
			else
			{
				Session::set_flash('error', 'タグを登録できませんでした');
			}
		}
		$data['tag'] = $tag;
		$this->template->title = "Tag";
		$this->template->content = View::forge('admin/tag/edit_confirm', $data);
	}

	public function action_delete($id = null)
	{
		if ($tag = Model_Tag::find($id))
		{
			$tag->delete();

			Session::set_flash('success', 'タグを削除しました');
		}

		else
		{
			Session::set_flash('error', 'タグを削除できませんでした');
		}

		Response::redirect('admin/tag');

	}

}
