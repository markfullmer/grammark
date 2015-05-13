// spec.js
describe('Grammark End-to-End Test Suite', function() {
  it('should have a title', function() {
    browser.get('http://localhost/grammark/#/resources/wordiness');

    expect(element(by.binding('title')).getText()).
        toEqual('Wordiness');
  });

  it('should return matches', function() {
    browser.get('http://localhost/grammark/');
    element(by.model('text')).sendKeys('This is a test of the nevertheless emergency moreover broadcast system.');
    element(by.id('button')).click();
    element(by.id('tab4')).click(); // go to "Transitions" tab
    var list = element.all(by.repeater('match in matches'));
    expect(list.getText()).
        toEqual([ 'moreover', 'nevertheless' ]);
  });

});