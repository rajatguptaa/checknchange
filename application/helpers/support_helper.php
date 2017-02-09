<?php

function getSupportForumDetail($category_id = NULL) {
    if ($category_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('category_id' => $category_id);
        $forumData = $CI->crm->getData('forum', '*', $where);
        return $forumData;
    } else
        return false;
}

function getCategoryName($category_id = NULL) {
    if ($category_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('forum_category_id' => $category_id);
        $forumData = $CI->crm->getData('forum_category', '*', $where);
        return $forumData;
    } else
        return false;
}

function getSupportForumDetailId($forum_id = NULL) {

    if ($forum_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('forum_id' => $forum_id);
        $forumData = $CI->crm->getData('forum', '*', $where);
//        return $CI->db->last_query();
        return $forumData;
    } else
        return false;
}

function getForumCategoryOrgid($category_id = NULL) {
    if ($category_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('forum_category_id' => $category_id);
        $forumData = $CI->crm->getData('forum_category', 'organisation_id', $where);
        return $forumData;
    } else
        return false;
}

function getForumCategoryId($organisation_id = NULL) {
    if ($organisation_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('organisation_id' => $organisation_id);

        $forumData = $CI->crm->getData('forum_category', 'forum_category_name,forum_category_id', $where);
        return $forumData;
    } else
        return false;
}

function getforumarticleCount($forum_id = NULL) {
    if ($forum_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('forum_id' => $forum_id);

        $forumData = $CI->crm->getRowCount('forum_article', '*', $where);
        return $forumData;
    } else
        return false;
}

function getforumarticle($forum_id = NULL) {
    if ($forum_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('forum_id' => $forum_id);

        $forumData = $CI->crm->getData('forum_article', '*', $where, $join = false, $order_by = false, $order = 'DESC', $limit = 3);
        return $forumData;
    } else
        return false;
}

function getforumarticleall($forum_id = NULL, $order_by = FALSE) {
    if ($forum_id != NULL) {
        $CI = & get_instance();

        $CI->load->model("crm_model");

        $where = array('forum_id' => $forum_id);
        $join = array(
            array('table' => 'user',
                'on' => 'user.user_id=forum_article.forum_article_created_by'
            ),
            array('table' => 'article_comment_rel',
                'on' => 'article_comment_rel.forum_article_id=forum_article.forum_article_id'
            ),
        );
        if ($order_by) {
            $forumData = $CI->crm->getData('forum_article', 'forum_article.*,user.*', $where, $join, $order_by, FALSE, FALSE, FALSE, FALSE, 'forum_article.forum_article_id');
        } else {
            $forumData = $CI->crm->getData('forum_article', 'forum_article.*,user.*', $where, $join, FALSE, FALSE, FALSE, FALSE, FALSE, 'forum_article.forum_article_id');
        }
        return $forumData;
    } else
        return false;
}

function posttype($posttype = NULL) {

    if ($posttype != NULL) {

        switch ($posttype) {
            case 'Articles':
                return $link_array = array('title' => 'Title', 'text' => 'Add Article ', 'edit' => 'Edit Article');
                break;
            case 'Ideas':
                return $link_array = array('title' => 'Suggest an Idea', 'text' => 'Suggest an Idea', 'edit' => 'Edit Idea');
                break;
            case 'Questions':
                return $link_array = array('title' => 'What \'s your question', 'text' => 'What \'s your question ? ', 'edit' => 'Edit a Question');
                break;
            default :
                break;
        }
    }
}

function getLockedRestriction($topiccreate = NULL) {
    if ($topiccreate != NULL) {

        if ($topiccreate == 'Agents only') {
            $lock = "<img class='pull-right' src='" . base_url('assets/images/lock.gif') . "'>";
            return $lock;
        } else {
            return FALSE;
        }
    }
}

function getattachement($attachementid = NULL) {
    $CI = & get_instance();
    if ($attachementid != NULL) {
        $where = array('attachment_id' => $attachementid);
        $forumData = $CI->crm->getData('attachment', '*', $where);
        return $forumData;
    } else {
        return FALSE;
    }
}

function getforumtypeicon($forumType = NULL,$size=FALSE) {

    if ($forumType != NULL) {

        switch ($forumType) {

            case 'Articles':
                if($size){
                return base_url().'assets/images/article.png';
                }else{
                 return base_url().'assets/images/article-small.png';
                }
                break;
            case 'Ideas':
                if($size){
                return base_url().'assets/images/idea.png';
                }else{
                 return base_url().'assets/images/idea-small.png';
                }
                break;
            case 'Questions':
               if($size){
                return base_url().'assets/images/question.png';
                }else{
                 return base_url().'assets/images/question-small.png';
                }
                break;
            default :
                break;
        }
    }
}

function getForumDetailByPost($forum_post_id = NULL) {
    $CI = & get_instance();
    if ($forum_post_id != NULL) {
        $where = array('forum_article_id' => $forum_post_id);
        $join = array(
            array('table' => 'forum',
                'on' => 'forum.forum_id=forum_article.forum_id')
        );
        $forumData = $CI->crm->getData('forum_article', '*', $where, $join);
        return $forumData;
    } else {
        return FALSE;
    }
}

function checkwhocreateforumpost($forum_post_id = NULL) {
    $CI = & get_instance();
    if ($forum_post_id != NULL) {
        $where = array('forum_article_id' => $forum_post_id);
        $forumData = $CI->crm->getData('forum_article', 'forum_article_created_by', $where);
        return $forumData;
    } else {
        return FALSE;
    }
}

function getDefaultCategoryId($org_id = NULL) {
    $CI = & get_instance();
    if ($org_id != NULL) {

        $where = array('organisation_id' => $org_id, 'forum_category_name' => 'None');
        $forumData = $CI->crm->getData('forum_category', 'forum_category_id', $where);
        return $forumData[0]['forum_category_id'];
    } else {
        return FALSE;
    }
}

function checkLikeStatus($postid = NULL, $loginuser = NULL) {
    $CI = & get_instance();
    if ($postid != NULL && $loginuser != NULL) {

        $where = array('article_id' => $postid, 'user_id' => $loginuser);
        $likestatus = $CI->crm->getRowCount('forum_article_like', '*', $where);

        if ($likestatus > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function countLike($postid = NULL) {
    $CI = & get_instance();
    if ($postid != NULL) {

        $where = array('article_id' => $postid);
        $likestatus = $CI->crm->getRowCount('forum_article_like', '*', $where);
        return $likestatus;
    }
}

function getLikeContent($forumType = NULL, $type = FALSE) {

    if ($forumType != NULL) {

        switch ($forumType) {

            case 'Articles':
                if ($type) {
                    return 'people found this useful.';
                } else {
                    return '<b>You</b> people found this useful.';
                }
                break;
            case 'Ideas':
                if ($type) {
                    return 'people like this.';
                } else {
                    return 'people like this.';
                }
                break;
            case 'Questions':
                if ($type) {
                    return 'people would like this to be answered.';
                } else {
                    return '<b>You</b> would like this to be answered.';
                }
                break;
            default :
                return 'like';
                break;
        }
    }
}

function getAnswerCount($postID) {
    $CI = & get_instance();
    if ($postID) {
        $count = $CI->crm->getRowCount('article_comment_rel', '', array('forum_article_id' => $postID, 'article_status' => 'Answer'));

        return $count;
    }
}

function getforumpostbycategory($category_id = NULL) {
    $CI = & get_instance();
    if ($category_id != NULL) {
        $where = array('forum_category_id' => $category_id, 'forum_article_homepage_status' => 1);
        $forum_article = $CI->crm->getData('forum_article', '*', $where);

        return $forum_article;
    }
}

function getIdeaStatus($article_id = NULL) {
    $CI = & get_instance();
    if ($article_id != NULL) {
        $where = array('forum_article_id' => $article_id);
        $forum_article = $CI->crm->getData('article_idea_status', '*', $where);
        if (!empty($forum_article)) {
            return $forum_article[0]['article_idea_status'];
        } else {
            return false;
        }
    }
}

function commentcount($postid) {
    $CI = & get_instance();
    $where = array('forum_article_id' => $postid);
    $comment = $CI->crm->getRowCount('article_comment_rel', 'comment_id', $where);
    return $comment;
}

function lastcommenttime($postid) {
    $CI = & get_instance();
    $where = array('forum_article_id' => $postid);
    $join = array(
        array('table'=>'comment',
            'on'=>'comment.comment_id=article_comment_rel.comment_id')
    );
    $comment = $CI->crm->getData('article_comment_rel', 'comment.comment_update', $where,$join,'comment.comment_update','DESC',1);
   
    if($comment){
        
        $date_a = new DateTime(date("Y-m-d H:i:s",  strtotime($comment[0]['comment_update'])));
                                $date_b = new DateTime($comment[0]['comment_update']);
                                $interval = date_diff($date_a, $date_b);
                                $days = $interval->format('%d');
                                $months = $interval->format('%m');
                                $year = $interval->format('%Y');
                                $time = explode(':', $interval->format('%H:%i:%s'));
                                if($days==0){
                                if ($time[0] < 1) {
                                    return $time[1] . ' min ago';
                                } elseif ($time[0] < 24 && $time[0] > 1) {
                                    return 'Today ' . $time[1] . ':' . $time[0];
                                }
                                }else{
                                  if($year>0){  
                                      return $year.' Year ago';
                                  } elseif($months>0){
                                       return $months.' Month ago';
                                  }else{
                                      
                                       return $days.' Days ago';
                                  }
                                  
                                }
        
        
        
    }else{
        return FALSE;
    }
}
