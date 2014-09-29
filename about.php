<?php 
include ('header.php');
if (isset($_GET['id']) && $_GET['id'] == 'start') { $_SESSION['text'] = '0';}
if (isset($_POST['text'])) { $_SESSION['text'] = $_POST['text'];}
if (isset($_SESSION['text']) && $_SESSION['text'] != '0')  {
	include ('menu.php');
	}
?>
<div style="width:500px;display:block;float:left;">
<p><b>Gram<span style="background-color:yellow">mark</span></b> helps improve writing style &amp; grammar and teaches students to self-edit. Basically, it finds things that grammarians consider to be bad, highlights them, and suggests improvements. So writers can measure progress, it gives a "score" based on problems per document length, which is updated whenever the writer fixes a problem.</p><p>Since not all writing forms are equal, users can customize each element that Gram<span style="background-color:yellow">mark</span> checks. It works best for college-level essays. It doesn't improve content. And it's not much use for creative writing, since literature often breaks rules for aesthetic effect. These are the basic premises the program follows, in plain language:</p>
<ol>
<li><b>Passive voice</b> is harder to read and sometimes obscures meaning. Active voice is clearer and punchier. Gram<span style="background-color:yellow">mark</span> highlights all instances of passive voice and suggests how to rewrite them actively.</li>
<li>Don't use 3 words when you can say the same thing with 1. Gram<span style="background-color:yellow">mark</span> has a database of <a href="wordiness-list.php">973 wordy phrases</a>, like <i>with respect to</i>, <i>a considerable amount of</i>, and <i>as a matter of fact</i>. It finds these and offers concise alternatives (<i>concerning, many, in fact</i>). </li>
<li><b>Sentence length</b> correlates with sophistication of thought. Writing with many short sentences is usually simplistic, while preponderantly long sentences suggest convoluted thought, and if sentences are all about the same length, writing sounds soporific. Gram<span style="background-color:yellow">mark</span> provides a sentence variety score (using standard deviation) and average words per sentence.</li>
<li><b>Transitions</b> help organize ideas. Writing that is short on transitions is often hard to follow. Based on analysis, writing that has less than 1 transition per every 4 sentences may be confusing. Gram<span style="background-color:yellow">mark</span> checks your document for <a href="transitions-list.php">188 common transition words</a>. </li>
<li>As a college writing teacher, I often find myself scribbling "<i>be more specific</i>" on student essays. Gram<span style="background-color:yellow">mark</span> checks your document against a list of <b>vague words</b>. </li>
<li><b>Grammar</b> is, quite simply, a bunch of rules writers follow. As a teacher, I've spent many a Saturday correcting grammar. Gram<span style="background-color:yellow">mark</span> searches for <a href="grammar-error-list.php">6,239 errors</a> in about 0.144 seconds.</li>
</ol>
<p>There are many more rules of grammar thumb: prepositions at the ends of phrases should be dealt with, to usually avoid split infinitives, and following parallel structure. But many of these have exceptions, and I felt including checks for them would make the tool less efficient and consequently less useful.</p>

<h2>Open Source</h2>
<p>I advocate <a href="http://www.opensource.org/docs/osd">open-source</a> philosophy: things (tools, art, knowledge) should be available for other people to adapt and improve. This includes educational web-tools like grammar checkers. So this website is both free to use and to modify. You can download the source codes here. The entire code is original, created using the open-source editor <a href="http://notepad-plus-plus.org/">Notepad++</a>, tested using <a href="http://www.easyphp.org/">EasyPHP</a> and Firefox and Chrome browsers, and all images were created using <a href="http://www.gimp.org/">GIMP</a>. Read the <a href="http://www.opensource.org/licenses/GPL-3.0">GNU General Public License here</a></p>
<h2>Make the Project Better</h2>
<p>The grammark database has 7,060 grammar rules currently, not including algorithms for identifying passive voice and analyzing sentences. Help improve the comprehensiveness of this tool by <a href="wordiness-list.php">adding more grammar rules</a>. Go to the submission form and enter a grammar error. If it doesn't yet exist, it will be added to the database after approval.</p>
<p>--Mark Fullmer</p>
<p><img src="mark-fullmer.jpg" alt="screenshot of Mark Fullmer" align="right" /><i>Mark Fullmer (M.A., English, <a href=http://www.bc.edu/">Boston College</a>, 2006) has taught college writing and creative writing in the United States and in the Philippines, where he was a <a href=http://peacecorps.gov/">Peace Corps</a> volunteer (2010-2012).</p><p>He maintains a website for writing tips, <a href="http://writing.markfullmer.com/">writing.markfullmer.com</a>, a pedagogy site for online teaching, <a href="http://howtoteachonline.org">howtoteachonline.org</a>, and a website for language and teaching resources in Waray-Waray, a language spoken by 3 million Filipinos, <a href="http://waraylanguage.org">waraylanguage.org</a>.</p>
</div>
<?php
include ('footer.php');
?>

