// spec.js
describe('Grammark End-to-End Test Suite', function() {
  var text = 'This is a being awoken canonization and. is about it\'s is seen prism <hr />awesome <b>totally</b> metaschism test of the nevertheless emergency moreover broadcast system.';
  var test = [];
  test['passiveRaw'] = '2 instances (100% of sentences)';
  test['passiveMatches'] = [ 'being awoken', 'is seen' ];
  test['transitionsRaw'] = '2 instances (100% of sentences)';
  test['transitionsMatches'] = [ 'moreover', 'nevertheless' ];
  test['grammarRaw'] = '1 instance';
  test['grammarMatches'] = [ 'about it\'s' ];


  it('should have a specific title', function() {
    browser.get('http://localhost/grammark/#/resources/wordiness');

    expect(element(by.binding('title')).getText()).
        toEqual('Wordiness');
  });

  it('should return matches present', function() {
    browser.get('http://localhost/grammark/');
    element(by.model('text')).sendKeys(text);
    element(by.id('button')).click();
   
    element(by.id('transitions')).click();
    var list = element.all(by.repeater('match in matches'));
    expect(list.getText()).
        toEqual(test['transitionsMatches']); 
    expect(element(by.binding('raw')).getText()).
        toEqual(test['transitionsRaw']);
    
    element(by.id('grammar')).click();
    var list = element.all(by.repeater('match in matches'));
    expect(list.getText()).
        toEqual(test['grammarMatches']); 
    expect(element(by.binding('raw')).getText()).
        toEqual(test['grammarRaw']);

    element(by.id('academic')).click();
    var list = element.all(by.repeater('match in matches'));
    expect(list.getText()).
        toEqual([ 'awesome', 'totally' ]);

    element(by.id('passive')).click();
    var list = element.all(by.repeater('match in matches'));
    expect(list.getText()).
        toEqual(test['passiveMatches']);
    expect(element(by.binding('raw')).getText()).
        toEqual(test['passiveRaw']);

    element(by.id('nominalizations')).click();
    var list = element.all(by.repeater('match in matches'));
    expect(list.getText()).
        toEqual([ 'canonization', 'metaschism' ]);
  });

/*  it('should return nominalizations present', function() {
    //browser.get('http://localhost/grammark/#/fix/nominalizations');
    element(by.model('text')).sendKeys('This is a test of the nevertheless emergency moreover broadcast system.');
    element(by.id('button')).click(); 
    element(by.id('nominalizations')).click(); // go to "Transitions" tab
    var list = element.all(by.repeater('match in matches'));
    expect(list.getText()).
        toEqual([ 'canonization', 'metaschism' ]);
  });*/

});