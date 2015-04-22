<?php

class Page {

  public $content;

  public function __construct() {
    $specific = preg_replace("/[^A-Za-z0-9?!]/",'',$_GET['url']);
    if (method_exists('Page',$specific)) {
      $this->$specific();
    }
  }

  public function spamcheck($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public function databaseadd() {
    $form = new Form();
    $this->content['message'] = $form->response();
    $this->content['content'] = 'place form here';
    $this->content['sidebar'] = 'sidebar here';
  }

  public function source() {
    $form = new Form();
    $this->content['message'] = 'Download grammark.org: A note about Open-Source';
    $this->content['content'] = '<h2>Open Source</h2>
<p>I advocate <a href="http://www.opensource.org/docs/osd">open-source</a> philosophy: things (tools, art, knowledge) should be available for other people to adapt and improve. This includes educational web-tools like grammar checkers. So this website is both free to use and to modify, so long as you allow others to do the same with whatever you create.
</p>
<p>
Read the <a href="http://www.opensource.org/licenses/GPL-3.0">GNU General Public License here</a>
</p>

<h2>Download</h2>
<p>Grammark is a web-based application. To run it, you need to have access to a webserver (or the equivalent on your local computer) with PHP and MySQL installed, and a basic knowledge of how to use them. The download includes installation and configuration instructions.</p>
<a class="button" href="https://github.com/markfullmer/grammark/archive/master.zip" />Download as zip</a>
<p>Or clone from Git:</p>
<code>
git clone https://github.com/markfullmer/grammark.git
</code>

<h2>The databases as human-readable webpages</h2>
<ul><li><a href="wordiness-list.php">Wordiness</a> (adapted from <a href="http://www.advanced-english-grammar.com/list-of-prepositional-phrases.html">advanced-english-grammar.com</a> & Dr. Kim Blank\'s <a href="http://web.uvic.ca/~gkblank/wordiness.html">list</a>)<br />
</li><li><a href="grammar-error-list.php">Grammar Errors</a> (adapted from the editors of <a href="http://en.wikipedia.org/wiki/Wikipedia:Lists_of_common_misspellings/Grammar_and_Misc">wikipedia.org list of grammar patterns</a>)<br />
</li><li><a href="transitions-list.php">Transitions</a> (adapted from <a href="http://www.smart-words.org/transition-words.html">smart-words.org</a>)<br /></li>
<li>Non-Academic/Informal language (including data from <a href="https://www.englishforums.com/English/FormalForm/bvhvmn/post.htm">Tran Manh Trung\'s list</a>)</ul>
';
    $this->content['title'] = 'Download | Grammark.org';
  }

  public function about() {
    $form = new Form();
    $this->content['message'] = 'About Grammark.org';
    $this->content['content'] = '<p><b>Gram<span style="background-color:yellow">mark</span></b> helps improve writing style &amp; grammar and teaches students to self-edit. Basically, it finds things that grammarians consider to be bad, highlights them, and suggests improvements. So writers can measure progress, it gives a "score" based on problems per document length, which is updated whenever the writer fixes a problem.</p><p>Since not all writing forms are equal, users can customize each element that Gram<span style="background-color:yellow">mark</span> checks. It works best for college-level essays. It doesn\'t improve content. And it\'s not much use for creative writing, since literature often breaks rules for aesthetic effect. These are the basic premises the program follows, in plain language:</p>
<ol>
<li><b>Passive voice</b> is harder to read and sometimes obscures meaning. Active voice is clearer and punchier. Gram<span style="background-color:yellow">mark</span> highlights all instances of passive voice and suggests how to rewrite them actively.</li>
<li>Don\'t use 3 words when you can say the same thing with 1. Gram<span style="background-color:yellow">mark</span> has a database of <a href="wordiness-list.php">973 wordy phrases</a>, like <i>with respect to</i>, <i>a considerable amount of</i>, and <i>as a matter of fact</i>. It finds these and offers concise alternatives (<i>concerning, many, in fact</i>). </li>
<li><b>Sentence length</b> correlates with sophistication of thought. Writing with many short sentences is usually simplistic, while preponderantly long sentences suggest convoluted thought, and if sentences are all about the same length, writing sounds soporific. Gram<span style="background-color:yellow">mark</span> provides a sentence variety score (using standard deviation) and average words per sentence.</li>
<li><b>Transitions</b> help organize ideas. Writing that is short on transitions is often hard to follow. Based on analysis, writing that has less than 1 transition per every 4 sentences may be confusing. Gram<span style="background-color:yellow">mark</span> checks your document for <a href="transitions-list.php">188 common transition words</a>. </li>
<li>As a college writing teacher, I often find myself scribbling "<i>be more specific</i>" on student essays. Gram<span style="background-color:yellow">mark</span> checks your document against a list of <b>vague words</b>. </li>
<li><b>Grammar</b> is, quite simply, a bunch of rules writers follow. As a teacher, I\'ve spent many a Saturday correcting grammar. Gram<span style="background-color:yellow">mark</span> searches for <a href="grammar-error-list.php">6,239 errors</a> in about 0.144 seconds.</li>
</ol>
<p>There are many more rules of grammar thumb: prepositions at the ends of phrases should be dealt with, to usually avoid split infinitives, and following parallel structure. But many of these have exceptions, and I felt including checks for them would make the tool less efficient and consequently less useful.</p>
<h2>Make the Project Better</h2>
<p>The grammark database has 7,060 grammar rules currently, not including algorithms for identifying passive voice and analyzing sentences. Help improve the comprehensiveness of this tool by <a href="database-add">adding more grammar rules</a>. Go to the submission form and enter a grammar error. If it doesn\'t yet exist, it will be added to the database after approval.</p>
<p>--Mark Fullmer</p>
<p><img src="./img/mark-fullmer.jpg" alt="screenshot of Mark Fullmer" align="right" /><i>Mark Fullmer (M.A., English, <a href=http://www.bc.edu/">Boston College</a>, 2006) has taught college writing and creative writing in the United States and in the Philippines, where he was a <a href=http://peacecorps.gov/">Peace Corps</a> volunteer (2010-2012).</p><p>He maintains a website for writing tips, <a href="http://writing.markfullmer.com/">writing.markfullmer.com</a>, a pedagogy site for online teaching, <a href="http://howtoteachonline.org">howtoteachonline.org</a>, and a website for language and teaching resources in Waray-Waray, a language spoken by 3 million Filipinos, <a href="http://corporaproject.org">corporaproject.org</a>.</p>';
    $this->content['title'] = 'About | Grammark.org';
  }


  public function contact() {
    if (isset($_REQUEST['email'])) {
      if ($this->spamcheck($_REQUEST['email']) == FALSE) {
        $response = '<span style="color:red;">You need to put a valid email address</a>';
      }
      elseif ($_REQUEST['cyborg'] != $_REQUEST['z']) {
        $response = '<span style="color:red;">Your math is wrong. Either you are a spam bot or you need to go back to grade 1.</span>';
      }
      else {
        $email = htmlspecialchars($_REQUEST['email']);
        $name = htmlspecialchars($_REQUEST['name']);
        $message = htmlspecialchars($_REQUEST['message']);
        mail(EMAIL, "Grammark: $name",
        $message, "From: $email" );
        $response =  "Your email was sent. We'll get back to you soon.";
      }
      $this->content['content'] = '<div class="panel">' . $response .'</div>';
    }
    $name = '';
    $email = '';
    $message = '';
    if (isset($_REQUEST['name'])) { $name = $_REQUEST['name']; }
    if (isset($_REQUEST['email'])) { $email = $_REQUEST['email']; }
    if (isset($_REQUEST['message'])) { $message = $_REQUEST['message']; }
    $x = rand(5,15);
    $y = rand(5,15);
    $z = $x+$y;
    $spamcheck = $x .' + '. $y .' = ';
    $this->content['title'] = 'Contact Us';
    $this->content['message'] = 'Emails will be answered with due expediency.';
    $this->content['content'] =
    t( '<form method="post" action="index.php?url=contact">
        <input name="name" type="text" placeholder="Name" value="%name" />
        <input name="email" type="text" placeholder="Email (for reply)" value="%email" />
        <textarea name="message" style="height:200px;" placeholder="Type your message here.">%message</textarea>
        <p>Prove you\'re not a spammy cyborg thingie:
        <input type="text" name="cyborg" placeholder="%spamcheck" style="width:100px;"></p>
        <input type="hidden" name="z" value="%z">
        <input class="button" type="submit" value="Email" />
        </form>
        </div>', array('%name' => $name, '%email' => $email, '%message' => $message, '%spamcheck' => $spamcheck, '%z' => $z)
    );
  }

  public function errorLinks() {
    $results = '<h2>Word Lists</h2>';
    $results .= '<h3>' . l('/transitions-list','Transitions') . '</h3>';
    $results .= '<h3>' . l('/grammar-error-list','Grammar Errors') . '</h3>';
    $results .= ' <h3>' . l('/wordiness-list','Wordiness List') . '</h3>';
    $results .= ' <h3>' . l('/spelling-errors','Common Spelling Errors') . '</h3>';
    $results .= ' <h3>' . l('/academic-style-list','Academic Style') . '</h3>';
    return $results;
  }

  public function transitionslist() {
    $data = new Data();
    $table = $data->getAllByTable('transitions');
    $content = '<table>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['transition'] . '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of transitions, used by Grammark to evaluate
      the flow of writing.',
      'title' => 'Transition List',
    );
  }

public function spellingerrors() {
    $data = new Data();
    $table = $data->getAllByTable('misspellings');
    $content = '<table><tr><th>Spelling Mistake</th><th>Correct Spelling</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['correct']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete spelling errors checked by Grammark.',
      'title' => 'Spelling List',
    );
  }

  public function academicstylelist() {
    $data = new Data();
    $table = $data->getAllByTable('academic');
    $content = '<table><tr><th>Informal / Casual</th><th>Academic Usage</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['suggestion']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of academic style checked by Grammark.',
      'title' => 'Academic Style List',
    );
  }

  public function grammarerrorlist() {
    $data = new Data();
    $table = $data->getAllByTable('miscellaneous');
    $content = '<table><tr><th>Grammar Error</th><th>Suggested Fix</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['correct']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of grammar errors checked by Grammark.',
      'title' => 'Grammar Error List',
    );
  }

  public function wordinesslist() {
    $data = new Data();
    $table = $data->getAllByTable('wordiness');
    $content = '<table><tr><th>Unnecessary Word(s)</th><th>Suggested Fix</th></tr>';
    foreach ($table as $key => $value) {
      $content .= '<tr><td>' . $value['error'] . '</td><td> ' . $value['correct']. '</td></tr>';
    }
    $content .= '</table>';
    $this->content = array(
      'content' => $content,
      'sidebar' => $this->errorLinks(),
      'message' => 'Complete list of words considered extraneous or unnecessary,
    with suggested fixes.',
    'title' => 'Wordiness List',
    );
  }
}
?>
