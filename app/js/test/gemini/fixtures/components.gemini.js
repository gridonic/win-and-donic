gemini.suite('dashboard', (suite) => {
    suite.setUrl('/gemini')
        .setCaptureElements('[data-gemini-container]')
        .capture('plain');
});
