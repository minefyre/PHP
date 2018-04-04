if (remain >= len) {
		rlen = len;
	} else {
		if (remain == 0) {
			return EOF;
		}
		rlen = remain
