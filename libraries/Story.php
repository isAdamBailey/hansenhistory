<?php

class Story {

	public function getAllStories()
	{
		$query = "SELECT * FROM tblStories ORDER BY id DESC";

        return $query;
	}

	public function getStoryById($id)
	{
		$query = "SELECT * FROM tblStories WHERE id = " .$id;

		return $query;
	}
	
	public function getStoriesAndCategories() 	// pulls in all stories and the associated categories
	{
		$query = "SELECT tblStories.*, tblCategories.Name FROM tblStories
            INNER JOIN tblCategories
            ON tblStories.CategoryId = tblCategories.id
            ORDER BY  tblStories.id DESC";

        return $query;
	}

	public function getStoryCategories()	// gets only catagory names that have a story
	{
		$query = "SELECT tc.id, Name FROM (SELECT DISTINCT * FROM tblCategories) as tc
            INNER JOIN tblStories
            ON tc.id = tblStories.CategoryId
            GROUP BY Name, tc.id";

        return $query;
	}

	public function getStoryByCategory($id)
	{
		$query = "SELECT * FROM tblStories WHERE CategoryId = " .$id;

		return $query;
	}

	public function getStorySubmitter($story)
	{
		$query = "SELECT Name FROM tblUsers
            INNER JOIN tblStories
            WHERE tblUsers.id = " .$story['UserId'];

        return $query;
	}

	public function setStory($submitter, $category, $title, $author, $body)
	{
		$query = "INSERT INTO tblStories
            (UserId,  CategoryId, Title, Author, Body)
            VALUES ('$submitter', '$category', '$title', '$author', '$body')";

        return $query;
	}

	public function updateStory($category, $title, $author, $body, $id)
	{
		$query = "UPDATE tblStories
            SET CategoryId = '$category',
                Title = '$title',
                Author = '$author',
                Body = '$body'              
            WHERE id = " .$id;

        return $query;
	}

	public function deleteStory($id)
	{
		$query = "DELETE FROM tblStories WHERE id = " .$id;

		return $query;
	}
	
	
	
}
