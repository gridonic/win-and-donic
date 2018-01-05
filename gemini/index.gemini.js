gemini.suite('dashboard', (suite) => {
    suite.setUrl('/')
        .setCaptureElements('[data-gemini-container]')
        .capture('plain');
});
