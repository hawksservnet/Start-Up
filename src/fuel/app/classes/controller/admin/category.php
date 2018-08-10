<?php
class Controller_Admin_Category extends Controller_Admin
{

	public function action_index()
	{
		$data['categories'] = Model_Category::find('all');
		$this->template->title = "Categories";
		$this->template->content = View::forge('admin/category/index', $data);

	}

	public function action_view($id = null)
	{
		$data['category'] = Model_Category::find($id);

		$this->template->title = "Category";
		$this->template->content = View::forge('admin/category/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Category::validate('create');

			if ($val->run())
			{
				$category = Model_Category::forge(array(
					'name' => Input::post('name'),
				));

				Session::set('Category.input.add', $category->to_array());
				Response::redirect('admin/category/create_confirm');
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Categories";
		$this->template->content = View::forge('admin/category/create');

	}
	public function action_create_confirm()
	{
		$category = Model_Category::forge(Session::get('Category.input.add'));
		if (Input::method() == 'POST')
		{
			if ($category->save())
			{
				Session::set_flash('success', 'カテゴリを登録しました');
				Response::redirect('admin/category');
			}
			else
			{
				Session::set_flash('error', 'カテゴリを登録できませんでした');
			}
		}
		$data['category'] = $category;
		$this->template->title = "Category";
		$this->template->content = View::forge('admin/category/edit_confirm', $data);
	}

	public function action_edit($id = null)
	{
		$category = Model_Category::find($id);
		$val = Model_Category::validate('edit', $id);
		if (Input::method() == 'POST')
		{
			if ($val->run())
			{
				$category->name = Input::post('name');
				Session::set('Category.input.'. $id, $category->to_array());
				Response::redirect('admin/category/edit_confirm/'. $id);
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->set_global('category', $category, false);
		$this->template->title = "Categories";
		$this->template->content = View::forge('admin/category/edit');

	}
	public function action_edit_confirm($id)
	{
		$category = Model_Category::find($id);
		$category->set(Session::get('Category.input.'. $id));
		if (Input::method() == 'POST')
		{
			if ($category->save())
			{
				Session::set_flash('success', 'カテゴリを登録しました');
				Response::redirect('admin/category');
			}
			else
			{
				Session::set_flash('error', 'カテゴリを登録できませんでした');
			}
		}
		$data['category'] = $category;
		$this->template->title = "Category";
		$this->template->content = View::forge('admin/category/edit_confirm', $data);
	}

	public function action_delete($id = null)
	{
		if ($category = Model_Category::find($id))
		{
			$category->delete();

			Session::set_flash('success', 'カテゴリを削除しました');
		}

		else
		{
			Session::set_flash('error', 'カテゴリを削除できませんでした');
		}

		Response::redirect('admin/category');

	}

}
