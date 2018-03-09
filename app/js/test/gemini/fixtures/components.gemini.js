gemini.suite('dashboard', (suite) => {
    suite.setUrl('http://lo.win-and-donic.ch/gemini')
        .setCaptureElements('[data-gemini-container]')
        .capture('plain');
});
